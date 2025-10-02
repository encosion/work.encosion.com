/**
 * Chat Prototype JavaScript
 * Handles the interactive chat simulation with HTML file streaming
 */

class ChatSystem {
    constructor() {
        this.conversationId = null;
        this.config = null;
        this.currentStep = 0;
        this.conversationSteps = [];
        this.isTyping = false;
        this.autoAdvanceAfterRender = false;
        this.messageContainer = null;
        this.userInput = null;
        this.sendButton = null;
        this.resetButton = null;
        this.loadButton = null;
    }

    init(conversationId, config) {
        this.conversationId = conversationId;
        this.config = config;
        this.messageContainer = document.getElementById('chatMessages');
        this.userInput = document.getElementById('userInput');
        this.sendButton = document.getElementById('sendButton');
        this.resetButton = document.getElementById('resetButton');
        this.loadButton = document.getElementById('loadButton');
        
        this.setupEventListeners();
        this.setupNavigationToggle();
        this.setupResizeHandle();
        this.loadConversation();
    }

    setupEventListeners() {
        // Send message on Enter key or button click
        if (this.userInput) {
            this.userInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    this.sendUserMessage();
                }
            });
        }

        if (this.sendButton) {
            this.sendButton.addEventListener('click', () => {
                this.sendUserMessage();
            });
        }

        // Reset conversation
        if (this.resetButton) {
            this.resetButton.addEventListener('click', () => {
                this.resetConversation();
            });
        }

        // Load example conversation
        if (this.loadButton) {
            this.loadButton.addEventListener('click', () => {
                this.loadExampleConversation();
            });
        }

        // Handle response links in messages
        if (this.messageContainer) {
            this.messageContainer.addEventListener('click', (e) => {
                if (e.target.classList.contains('response-link')) {
                    e.preventDefault();
                    const response = e.target.getAttribute('data-response');
                    this.submitResponseLink(response);
                }
            });
        }
    }

    setupNavigationToggle() {
        // Find the Ray button in the navigation
        const rayButton = document.querySelector('.nav-icon[title="Ray"]');
        const chatSection = document.querySelector('.chat-section');
        
        if (rayButton && chatSection) {
            rayButton.addEventListener('click', () => {
                chatSection.classList.toggle('hidden');
            });
        }
    }

    setupResizeHandle() {
        const chatSection = document.querySelector('.chat-section');
        
        if (chatSection) {
            let isResizing = false;
            let startX = 0;
            let startWidth = 0;

            // Mouse down on resize handle
            chatSection.addEventListener('mousedown', (e) => {
                // Don't allow resize if chat section is hidden
                if (chatSection.classList.contains('hidden')) {
                    return;
                }
                
                // Check if clicking on the resize handle (right edge)
                const rect = chatSection.getBoundingClientRect();
                const handleWidth = 8;
                
                if (e.clientX >= rect.right - handleWidth) {
                    isResizing = true;
                    startX = e.clientX;
                    startWidth = chatSection.offsetWidth;
                    
                    // Disable transition during resize
                    chatSection.style.transition = 'none';
                    
                    // Prevent text selection
                    document.body.style.userSelect = 'none';
                    
                    e.preventDefault();
                }
            });

            // Mouse move for resizing
            document.addEventListener('mousemove', (e) => {
                if (isResizing) {
                    const deltaX = e.clientX - startX;
                    const newWidth = startWidth + deltaX;
                    const minWidth = 338;
                    const maxWidth = 800;
                    
                    // Constrain width within limits
                    const constrainedWidth = Math.max(minWidth, Math.min(maxWidth, newWidth));
                    chatSection.style.width = constrainedWidth + 'px';
                }
            });

            // Mouse up to stop resizing
            document.addEventListener('mouseup', () => {
                if (isResizing) {
                    isResizing = false;
                    
                    // Re-enable transition
                    chatSection.style.transition = 'transform 0.3s ease';
                    
                    // Re-enable text selection
                    document.body.style.userSelect = '';
                }
            });

            // Prevent context menu on resize handle
            chatSection.addEventListener('contextmenu', (e) => {
                const rect = chatSection.getBoundingClientRect();
                const handleWidth = 8;
                
                if (e.clientX >= rect.right - handleWidth) {
                    e.preventDefault();
                }
            });
        }
        
        // Update selection bar position when chat section is resized
        this.updateSelectionBarPosition();
    }
    
    updateSelectionBarPosition() {
        const chatSection = document.querySelector('.chat-section');
        const selectionBar = document.querySelector('.selection-bar');
        const candidateCards = document.querySelector('.candidate-cards');
        
        if (!chatSection || !selectionBar) return;
        
        const updatePosition = () => {
            const chatRect = chatSection.getBoundingClientRect();
            const pageLayout = document.querySelector('.page-layout');
            const pageLayoutRect = pageLayout.getBoundingClientRect();
            
            // Position selection bar to start after the chat section
            const leftOffset = chatRect.right - pageLayoutRect.left;
            
            // If candidate cards exist, match their width
            if (candidateCards) {
                const candidateCardsRect = candidateCards.getBoundingClientRect();
                const candidateCardsWidth = candidateCardsRect.width;
                
                selectionBar.style.left = leftOffset + 'px';
                selectionBar.style.width = candidateCardsWidth + 'px';
                selectionBar.style.right = 'auto';
            } else {
                // Fallback to full width if candidate cards not loaded yet
                selectionBar.style.left = leftOffset + 'px';
                selectionBar.style.right = '0px';
                selectionBar.style.width = 'auto';
            }
        };
        
        // Update position on resize
        const resizeObserver = new ResizeObserver(updatePosition);
        resizeObserver.observe(chatSection);
        
        // Also observe candidate cards if they exist
        if (candidateCards) {
            resizeObserver.observe(candidateCards);
        }
        
        // Initial position
        updatePosition();
    }

    async loadConversation() {
        try {
            // Load conversation files automatically
            const response = await fetch(`list_files.php?conversation=${this.conversationId}`);
            if (response.ok) {
                this.conversationSteps = await response.json();
                this.startConversation();
            } else {
                console.error('Failed to load conversation files');
                this.showErrorMessage('Failed to load conversation. Please try again.');
            }
        } catch (error) {
            console.error('Error loading conversation:', error);
            this.showErrorMessage('Error loading conversation. Please check your connection.');
        }
    }

    async startConversation() {
        console.log('Starting conversation with steps:', this.conversationSteps);
        if (this.conversationSteps.length === 0) {
            this.showErrorMessage('No conversation steps found.');
            return;
        }

        this.currentStep = 0;
        await this.processNextStep();
    }

    async processNextStep() {
        if (this.currentStep >= this.conversationSteps.length) {
            // Conversation ended - no message needed
            return;
        }

        const step = this.conversationSteps[this.currentStep];
        console.log(`Processing step ${this.currentStep}:`, step);
        
        if (step.type === 'agent') {
            await this.showAgentMessage(step);
        } else if (step.type === 'user') {
            this.waitForUserInput(step);
        } else if (step.type === 'auto') {
            // Auto-advance after a delay
            setTimeout(() => {
                this.currentStep++;
                this.processNextStep();
            }, step.delay || 1000);
        }
        
        // Initialize role selection components after message is displayed
        setTimeout(() => {
            this.initializeRoleSelectionComponents();
            this.initializeLoadButtons();
        }, 100);
    }

    async showAgentMessage(step) {
        this.isTyping = true;
        this.showTypingIndicator();

        try {
            // Load HTML content
            const response = await fetch(`conversations/${this.conversationId}/${step.file}`);
            if (!response.ok) {
                throw new Error(`Failed to load ${step.file}`);
            }
            
            const htmlContent = await response.text();
            
            // Parse system commands from the HTML content
            const { cleanContent, commands } = this.parseSystemCommands(htmlContent);
            
            // Remove typing indicator
            this.hideTypingIndicator();
            
            // Handle system commands first to set up auto-advance
            await this.handleSystemCommands(commands);
            
            // Show message with appropriate rendering mode
            await this.typeMessage(cleanContent, commands);
            
            this.isTyping = false;
            
            // Only increment step if not waiting for user input
            if (commands.nextAction === 'wait') {
                // Don't increment - wait for user input
            } else {
                // Auto-advance cases will handle their own step increment
                // No need to increment here
            }
            
        } catch (error) {
            console.error('Error loading agent message:', error);
            this.hideTypingIndicator();
            this.showErrorMessage(`Error loading message: ${error.message}`);
        }
    }

    waitForUserInput(step) {
        // Only enable input if it's not already populated by autoPopulateInput
        if (!this.userInput.value) {
            this.userInput.disabled = false;
            this.sendButton.disabled = false;
            this.userInput.focus();
        }
        
        if (step.placeholder) {
            this.userInput.placeholder = step.placeholder;
        }
        
        // Show suggestions only if no file is specified
        if (step.suggestions && !step.file) {
            this.showSuggestions(step.suggestions);
        }
    }


    async sendUserMessage() {
        const message = this.userInput.value.trim();
        if (!message) return;

        // Add user message to chat
        this.addMessage('user', message);
        
        // Clear input
        this.userInput.value = '';
        this.userInput.disabled = true;
        this.sendButton.disabled = true;
        
        // Hide suggestions
        this.hideSuggestions();
        
        // Process the user input
        await this.processUserInput(message);
    }

    async processUserInput(userMessage) {
        // Show thinking animation for 200ms
        this.showThinkingAnimation();
        
        // Wait 200ms then advance to next step
        setTimeout(async () => {
            this.hideThinkingAnimation();
            this.currentStep++;
            await this.processNextStep();
        }, 1000);
    }

    async submitResponseLink(response) {
        // Add user message to chat
        this.addMessage('user', response);
        
        // Clear input
        this.userInput.value = '';
        this.userInput.disabled = true;
        this.sendButton.disabled = true;
        
        // Hide suggestions
        this.hideSuggestions();
        
        // Process the response
        await this.processUserInput(response);
    }

    findMatchingResponse(userMessage, responses) {
        const message = userMessage.toLowerCase();
        
        for (const response of responses) {
            if (response.keywords) {
                for (const keyword of response.keywords) {
                    if (message.includes(keyword.toLowerCase())) {
                        return response;
                    }
                }
            }
            
            if (response.exact) {
                if (message === response.exact.toLowerCase()) {
                    return response;
                }
            }
        }
        
        return responses.find(r => r.default) || null;
    }

    async typeMessage(content, commands = {}) {
        const messageElement = this.createMessageElement('agent', '');
        this.messageContainer.appendChild(messageElement);
        
        const contentElement = messageElement.querySelector('.message-content');
        const renderMode = commands.render || 'stream';
        const delay = commands.typingDelay || 10;
        
        // Check if content contains HTML tags
        const hasHtmlTags = /<[^>]*>/g.test(content);
        
        if (hasHtmlTags) {
            // For HTML content, handle based on render mode
            contentElement.innerHTML = content;
            contentElement.style.opacity = '0';
            
            if (renderMode === 'appear') {
                // Quick fade-in for complex components
                console.log('Rendering in Appear mode');
                await this.fadeInElement(contentElement, 200);
            } else {
                // Stream mode - character by character for text content
                console.log('Rendering in Stream mode');
                await this.streamHtmlContent(contentElement, delay);
            }
            
            // Check for different component types and initialize them
            const streamingElement = contentElement.querySelector('[data-streaming-component="true"]');
            const thinkingElement = contentElement.querySelector('#thinking-steps');
            const contentElement_check = contentElement.querySelector('#content-section');
            
            if (streamingElement) {
                console.log('Found streaming component element, initializing...');
                this.initializeStreamingComponent(streamingElement);
            } else if (thinkingElement) {
                console.log('Found thinking component element, initializing...');
                await this.initializeThinkingComponent(thinkingElement, commands.thinkingSteps);
                // Thinking components handle their own auto-advance, so we're done here
                return;
            } else if (contentElement_check) {
                console.log('Found content component element, initializing...');
                this.initializeContentComponent(contentElement_check);
            } else {
                console.log('No special component found');
            }
        } else {
            // For plain text, use character-by-character typing effect
            if (renderMode === 'appear') {
                // Quick fade-in for plain text too
                contentElement.textContent = content;
                await this.fadeInElement(contentElement, 200);
            } else {
                // Stream mode - character by character
                const words = content.split(' ');
                let currentText = '';
                
                for (let i = 0; i < words.length; i++) {
                    currentText += (i > 0 ? ' ' : '') + words[i];
                    contentElement.textContent = currentText;
                    
                    // Scroll to bottom
                    this.scrollToBottom();
                    
                    await this.sleep(delay);
                }
            }
        }
        
        // Scroll to bottom
        this.scrollToBottom();
        
        // Check if we should auto-advance after rendering is complete
        if (this.autoAdvanceAfterRender) {
            this.autoAdvanceAfterRender = false;
            setTimeout(() => {
                this.currentStep++;
                this.processNextStep();
            }, 100); // Small delay to ensure UI is settled
        }
    }
    
    async streamHtmlContent(contentElement, delay) {
        const htmlContent = contentElement.innerHTML;
        
        // Clear the content and make it visible
        contentElement.innerHTML = '';
        contentElement.style.opacity = '1';
        
        // If content has HTML tags, stream while preserving structure
        if (htmlContent.includes('<')) {
            await this.streamHtmlWithStructure(contentElement, htmlContent, delay);
        } else {
            // Simple text streaming for content without HTML
            const textContent = htmlContent;
            for (let i = 0; i < textContent.length; i++) {
                const currentText = textContent.substring(0, i + 1);
                contentElement.textContent = currentText;
                
                // Scroll to bottom
                this.scrollToBottom();
                
                await this.sleep(delay);
            }
        }
    }
    
    async streamHtmlWithStructure(contentElement, htmlContent, delay) {
        // Create a temporary element to parse the HTML
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = htmlContent;
        
        // Extract text content while preserving structure
        const textContent = tempDiv.textContent || tempDiv.innerText || '';
        
        // Stream character by character while maintaining HTML structure
        let currentText = '';
        let currentIndex = 0;
        
        for (let i = 0; i < textContent.length; i++) {
            currentText += textContent[i];
            
            // Rebuild HTML structure with current text
            const streamedHtml = this.rebuildHtmlWithText(htmlContent, currentText);
            contentElement.innerHTML = streamedHtml;
            
            // Scroll to bottom
            this.scrollToBottom();
            
            await this.sleep(delay);
        }
    }
    
    rebuildHtmlWithText(originalHtml, currentText) {
        // Simple approach: replace text content while preserving tags
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = originalHtml;
        
        // Get all text nodes and replace with current text
        const walker = document.createTreeWalker(
            tempDiv,
            NodeFilter.SHOW_TEXT,
            null,
            false
        );
        
        const textNodes = [];
        let node;
        while (node = walker.nextNode()) {
            textNodes.push(node);
        }
        
        // Replace text content
        let textIndex = 0;
        for (const textNode of textNodes) {
            const originalText = textNode.textContent;
            const remainingText = currentText.substring(textIndex);
            const textToShow = remainingText.substring(0, originalText.length);
            textNode.textContent = textToShow;
            textIndex += originalText.length;
        }
        
        return tempDiv.innerHTML;
    }

    async fadeInElement(element, duration = 300) {
        return new Promise((resolve) => {
            element.style.transition = `opacity ${duration}ms ease-in-out`;
            element.style.opacity = '1';
            
            setTimeout(() => {
                resolve();
            }, duration);
        });
    }

    addMessage(type, content) {
        const messageElement = this.createMessageElement(type, content);
        this.messageContainer.appendChild(messageElement);
        this.scrollToBottom();
    }

    createMessageElement(type, content) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        
        const bubbleDiv = document.createElement('div');
        bubbleDiv.className = 'message-bubble';
        
        const contentDiv = document.createElement('div');
        contentDiv.className = 'message-content';
        
        if (typeof content === 'string') {
            contentDiv.innerHTML = content;
        } else {
            contentDiv.appendChild(content);
        }
        
        bubbleDiv.appendChild(contentDiv);
        messageDiv.appendChild(bubbleDiv);
        
        return messageDiv;
    }

    showTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'message agent typing-indicator';
        typingDiv.id = 'typingIndicator';
        
        const bubbleDiv = document.createElement('div');
        bubbleDiv.className = 'message-bubble';
        
        const indicatorDiv = document.createElement('div');
        indicatorDiv.className = 'typing-indicator';
        indicatorDiv.innerHTML = '<span></span><span></span><span></span>';
        
        bubbleDiv.appendChild(indicatorDiv);
        typingDiv.appendChild(bubbleDiv);
        
        this.messageContainer.appendChild(typingDiv);
        this.scrollToBottom();
    }

    hideTypingIndicator() {
        const typingIndicator = document.getElementById('typingIndicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    showThinkingAnimation() {
        const thinkingDiv = document.createElement('div');
        thinkingDiv.className = 'message agent thinking-animation';
        thinkingDiv.id = 'thinkingAnimation';
        
        const bubbleDiv = document.createElement('div');
        bubbleDiv.className = 'message-bubble';
        
        const indicatorDiv = document.createElement('div');
        indicatorDiv.className = 'thinking-indicator';
        indicatorDiv.innerHTML = '<svg class="spinning-ray-icon" width="16" height="16" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.41601 12.2368L7.42382 16.2515C7.4238 16.4324 7.37535 16.6138 7.28613 16.77C7.19692 16.9262 7.0749 17.0575 6.92089 17.1479C6.76683 17.2384 6.59634 17.2875 6.41796 17.2876C6.23959 17.2876 6.0691 17.2383 5.91503 17.1479C5.76103 17.0576 5.63902 16.9261 5.5498 16.77C5.46057 16.6138 5.41115 16.4324 5.41113 16.2515V11.0356L7.41601 12.2368ZM13.915 13.1421C14.069 13.2326 14.1989 13.3639 14.2881 13.52C14.3772 13.6762 14.4257 13.849 14.4258 14.0298C14.4258 14.2108 14.3851 14.3842 14.2959 14.5405C14.2066 14.6967 14.0769 14.8202 13.9228 14.9106C13.7687 15.0011 13.5896 15.0425 13.4111 15.0425C13.2328 15.0424 13.0544 14.9922 12.9004 14.9019L8.44628 12.2944L10.4746 11.1343L13.915 13.1421ZM4.94921 10.1147L1.52538 12.1216C1.37132 12.212 1.19302 12.2621 1.01464 12.2622C0.836144 12.2622 0.65708 12.2209 0.502922 12.1304C0.348861 12.0399 0.219108 11.9164 0.129875 11.7603C0.0406267 11.604 -7.62939e-06 11.4305 -7.62939e-06 11.2495C6.92342e-05 11.0687 0.0485155 10.8959 0.137688 10.7397C0.226935 10.5835 0.357555 10.4523 0.511711 10.3618L4.96581 7.75342L4.94921 10.1147ZM14.9853 5.74658C15.1638 5.74658 15.3429 5.78793 15.4971 5.87842C15.6511 5.9689 15.7809 6.09231 15.8701 6.24854C15.9593 6.40475 16 6.57742 16 6.7583C16 6.93907 15.9514 7.11191 15.8623 7.26807C15.773 7.42436 15.6424 7.5565 15.4883 7.64697L11.0342 10.2632L11.0508 7.90186L14.4746 5.88623C14.6286 5.79587 14.807 5.74663 14.9853 5.74658ZM9.58202 0.712402C9.76042 0.712402 9.93087 0.761664 10.085 0.852051C10.2391 0.942537 10.3609 1.07466 10.4502 1.23096C10.5393 1.38713 10.5878 1.56773 10.5879 1.74854V6.96436L8.58398 5.771L8.57616 1.74854C8.5762 1.56781 8.62481 1.38709 8.71386 1.23096C8.8031 1.07468 8.92497 0.942536 9.07909 0.852051C9.23318 0.761602 9.40361 0.712445 9.58202 0.712402ZM2.58788 2.96631C2.76638 2.96631 2.94544 3.01547 3.0996 3.10596L7.5537 5.71338L5.52538 6.87354L2.08495 4.8667C1.93084 4.77621 1.80114 4.64406 1.71191 4.48779C1.62274 4.33156 1.57421 4.1589 1.57421 3.97803C1.57422 3.79708 1.61488 3.62453 1.70409 3.46826C1.79333 3.31199 1.92301 3.18862 2.07714 3.09814C2.2312 3.00771 2.4095 2.96636 2.58788 2.96631Z" fill="#492FF4"/></svg><span class="thinking-text">Thinking...</span>';
        
        bubbleDiv.appendChild(indicatorDiv);
        thinkingDiv.appendChild(bubbleDiv);
        
        this.messageContainer.appendChild(thinkingDiv);
        this.scrollToBottom();
    }

    hideThinkingAnimation() {
        const thinkingAnimation = document.getElementById('thinkingAnimation');
        if (thinkingAnimation) {
            thinkingAnimation.remove();
        }
    }

    showSuggestions(suggestions) {
        // Create suggestions container
        let suggestionsContainer = document.getElementById('suggestions');
        if (!suggestionsContainer) {
            suggestionsContainer = document.createElement('div');
            suggestionsContainer.id = 'suggestions';
            suggestionsContainer.className = 'suggestions-container';
            document.querySelector('.chat-input-container').appendChild(suggestionsContainer);
        }
        
        suggestionsContainer.innerHTML = '';
        
        suggestions.forEach(suggestion => {
            const button = document.createElement('button');
            button.className = 'suggestion-button';
            button.textContent = suggestion;
            button.addEventListener('click', () => {
                this.userInput.value = suggestion;
                this.sendUserMessage();
            });
            suggestionsContainer.appendChild(button);
        });
    }

    hideSuggestions() {
        const suggestionsContainer = document.getElementById('suggestions');
        if (suggestionsContainer) {
            suggestionsContainer.remove();
        }
    }

    parseMarkdown(markdown) {
        // Simple markdown parser for basic formatting
        let html = markdown
            // Headers
            .replace(/^### (.*$)/gim, '<h3>$1</h3>')
            .replace(/^## (.*$)/gim, '<h2>$1</h2>')
            .replace(/^# (.*$)/gim, '<h1>$1</h1>')
            // Bold
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            // Italic
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            // Code
            .replace(/`(.*?)`/g, '<code>$1</code>')
            // Response links (special syntax: [text](response:response_text))
            .replace(/\[([^\]]+)\]\(response:([^)]+)\)/g, '<a href="#" class="response-link" data-response="$2">$1</a>')
            // Regular links
            .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank">$1</a>')
            // Line breaks
            .replace(/\n/g, '<br>');
        
        return html;
    }

    initializeRoleSelectionComponents() {
        const roleComponents = document.querySelectorAll('[data-component="role-selection"]');
        
        roleComponents.forEach(component => {
            const roleOptions = component.querySelectorAll('.role-option');
            
            roleOptions.forEach(option => {
                // Check if event listener is already attached
                if (!option.hasAttribute('data-listener-attached')) {
                option.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.handleRoleSelection(option, component);
                });
                    // Mark as having listener attached
                    option.setAttribute('data-listener-attached', 'true');
                }
            });
        });
    }
    
    initializeLoadButtons() {
        const loadButtons = document.querySelectorAll('button[load-]');
        
        loadButtons.forEach(button => {
            const filePath = button.getAttribute('load-');
            if (filePath) {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.loadContentIntoEmojiContainer(filePath);
                });
                
                // Add loading state styling
                button.addEventListener('click', () => {
                    const originalText = button.textContent;
                    button.textContent = 'Loading...';
                    button.disabled = true;
                    
                    // Reset button state after a delay
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.disabled = false;
                    }, 2000);
                });
            }
        });
    }

    handleRoleSelection(selectedOption, component) {
        const roleTitle = selectedOption.querySelector('.role-title').textContent;
        
        // Add selected state
        selectedOption.classList.add('selected');
        
        // Disable all role options to prevent further selection
        const allRoleOptions = component.querySelectorAll('.role-option');
        allRoleOptions.forEach(option => {
            option.style.pointerEvents = 'none';
            option.style.opacity = '0.6';
            option.classList.add('disabled');
        });
        
        // Add user message with selected role after a brief delay
        setTimeout(() => {
            this.addMessage('user', roleTitle);
            
            // Keep the role selection component visible
            // Don't hide the component - leave all options on the page
            
            // Advance to next step
            setTimeout(() => {
                this.currentStep++;
                this.processNextStep();
            }, 500);
        }, 200);
    }

    scrollToBottom() {
        this.messageContainer.scrollTop = this.messageContainer.scrollHeight;
    }

    sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    resetConversation() {
        this.messageContainer.innerHTML = '';
        this.currentStep = 0;
        this.isTyping = false;
        this.userInput.disabled = false;
        this.sendButton.disabled = false;
        this.userInput.value = '';
        this.userInput.placeholder = 'Type your message...';
        this.hideSuggestions();
        this.startConversation();
    }

    async loadExampleConversation() {
        // Load the tutorial conversation
        const exampleId = 'default';
        this.conversationId = exampleId;
        
        // Clear the input field
        this.userInput.value = '';
        this.userInput.disabled = true;
        this.sendButton.disabled = true;
        this.hideSuggestions();
        
        // Update the URL to reflect the new conversation
        const url = new URL(window.location);
        url.searchParams.set('conversation', exampleId);
        window.history.pushState({}, '', url);
        
        await this.loadConversation();
    }

    showErrorMessage(message) {
        this.addMessage('agent', `<strong>Error:</strong> ${message}`);
    }


    
    initializeStreamingComponent(streamingElement) {
        console.log('Initializing streaming component...');
        
        // Create the streaming component
        const firstLine = "Ok, so we're looking for Senior Product Owners. Let me dig into this and get a search started for you.";
        
        // Start the streaming animation
        this.startStreamingAnimation(streamingElement, firstLine);
    }
    
    async initializeThinkingComponent(thinkingElement, thinkingSteps = null) {
        console.log('Initializing thinking component...');
        
        if (thinkingSteps && thinkingSteps.length > 0) {
            // Generate thinking steps dynamically
            this.generateThinkingSteps(thinkingElement, thinkingSteps);
        }
        
        // Start the thinking animation and wait for it to complete
        await this.startThinkingAnimation();
    }
    
    generateThinkingSteps(container, steps) {
        container.innerHTML = '';
        
        steps.forEach((stepText, index) => {
            const stepDiv = document.createElement('div');
            stepDiv.className = 'thinking-step';
            stepDiv.setAttribute('data-step', index);
            
            const spinnerDiv = document.createElement('div');
            spinnerDiv.className = 'thinking-spinner';
            spinnerDiv.innerHTML = '<svg class="spinning-ray-icon" width="16" height="16" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.41601 12.2368L7.42382 16.2515C7.4238 16.4324 7.37535 16.6138 7.28613 16.77C7.19692 16.9262 7.0749 17.0575 6.92089 17.1479C6.76683 17.2384 6.59634 17.2875 6.41796 17.2876C6.23959 17.2876 6.0691 17.2383 5.91503 17.1479C5.76103 17.0576 5.63902 16.9261 5.5498 16.77C5.46057 16.6138 5.41115 16.4324 5.41113 16.2515V11.0356L7.41601 12.2368ZM13.915 13.1421C14.069 13.2326 14.1989 13.3639 14.2881 13.52C14.3772 13.6762 14.4257 13.849 14.4258 14.0298C14.4258 14.2108 14.3851 14.3842 14.2959 14.5405C14.2066 14.6967 14.0769 14.8202 13.9228 14.9106C13.7687 15.0011 13.5896 15.0425 13.4111 15.0425C13.2328 15.0424 13.0544 14.9922 12.9004 14.9019L8.44628 12.2944L10.4746 11.1343L13.915 13.1421ZM4.94921 10.1147L1.52538 12.1216C1.37132 12.212 1.19302 12.2621 1.01464 12.2622C0.836144 12.2622 0.65708 12.2209 0.502922 12.1304C0.348861 12.0399 0.219108 11.9164 0.129875 11.7603C0.0406267 11.604 -7.62939e-06 11.4305 -7.62939e-06 11.2495C6.92342e-05 11.0687 0.0485155 10.8959 0.137688 10.7397C0.226935 10.5835 0.357555 10.4523 0.511711 10.3618L4.96581 7.75342L4.94921 10.1147ZM14.9853 5.74658C15.1638 5.74658 15.3429 5.78793 15.4971 5.87842C15.6511 5.9689 15.7809 6.09231 15.8701 6.24854C15.9593 6.40475 16 6.57742 16 6.7583C16 6.93907 15.9514 7.11191 15.8623 7.26807C15.773 7.42436 15.6424 7.5565 15.4883 7.64697L11.0342 10.2632L11.0508 7.90186L14.4746 5.88623C14.6286 5.79587 14.807 5.74663 14.9853 5.74658ZM9.58202 0.712402C9.76042 0.712402 9.93087 0.761664 10.085 0.852051C10.2391 0.942537 10.3609 1.07466 10.4502 1.23096C10.5393 1.38713 10.5878 1.56773 10.5879 1.74854V6.96436L8.58398 5.771L8.57616 1.74854C8.5762 1.56781 8.62481 1.38709 8.71386 1.23096C8.8031 1.07468 8.92497 0.942536 9.07909 0.852051C9.23318 0.761602 9.40361 0.712445 9.58202 0.712402ZM2.58788 2.96631C2.76638 2.96631 2.94544 3.01547 3.0996 3.10596L7.5537 5.71338L5.52538 6.87354L2.08495 4.8667C1.93084 4.77621 1.80114 4.64406 1.71191 4.48779C1.62274 4.33156 1.57421 4.1589 1.57421 3.97803C1.57422 3.79708 1.61488 3.62453 1.70409 3.46826C1.79333 3.31199 1.92301 3.18862 2.07714 3.09814C2.2312 3.00771 2.4095 2.96636 2.58788 2.96631Z" fill="#492FF4"/></svg>';
            
            const textSpan = document.createElement('span');
            textSpan.className = 'thinking-text';
            textSpan.textContent = stepText;
            
            stepDiv.appendChild(spinnerDiv);
            stepDiv.appendChild(textSpan);
            container.appendChild(stepDiv);
        });
    }
    
    initializeContentComponent(contentElement) {
        console.log('Initializing content component...');
        
        // Show the content section
        setTimeout(() => {
            contentElement.classList.add('visible');
            console.log('Content section revealed');
        }, 100);
    }
    
    async startStreamingAnimation(streamingElement, firstLine) {
        console.log('Starting streaming animation...');
        
        // Stream the first line
        console.log('Streaming first line:', firstLine);
        await this.streamText(streamingElement, firstLine);
        
        console.log('Streaming complete');
        
        // Auto-advance to next step after streaming is complete
        setTimeout(() => {
            this.currentStep++;
            this.processNextStep();
        }, 1000);
    }
    
    async startThinkingAnimation() {
        console.log('Starting thinking animation...');
        
        const steps = document.querySelectorAll('.thinking-step');
        
        for (let i = 0; i < steps.length; i++) {
            // Activate current step
            steps[i].classList.add('active');
            
            // Wait for step duration
            await this.delay(800);
            
            // Mark as completed and replace spinner with check icon
            steps[i].classList.add('completed');
            steps[i].classList.remove('active');
            
            // Replace spinner with check icon
            const spinner = steps[i].querySelector('.thinking-spinner');
            if (spinner) {
                spinner.innerHTML = '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.4237 5.96938C11.4936 6.03905 11.5491 6.12185 11.5869 6.21301C11.6248 6.30417 11.6443 6.40191 11.6443 6.50063C11.6443 6.59934 11.6248 6.69708 11.5869 6.78824C11.5491 6.8794 11.4936 6.9622 11.4237 7.03188L7.92369 10.5319C7.85402 10.6018 7.77122 10.6573 7.68006 10.6951C7.58889 10.733 7.49115 10.7525 7.39244 10.7525C7.29373 10.7525 7.19599 10.733 7.10483 10.6951C7.01367 10.6573 6.93087 10.6018 6.86119 10.5319L5.36119 9.03187C5.29143 8.96211 5.23609 8.87929 5.19833 8.78814C5.16058 8.69698 5.14114 8.59929 5.14114 8.50062C5.14114 8.40196 5.16058 8.30427 5.19833 8.21311C5.23609 8.12196 5.29143 8.03914 5.36119 7.96938C5.43096 7.89961 5.51378 7.84427 5.60493 7.80651C5.69609 7.76876 5.79378 7.74932 5.89244 7.74932C5.99111 7.74932 6.0888 7.76876 6.17995 7.80651C6.27111 7.84427 6.35393 7.89961 6.42369 7.96938L7.39307 8.9375L10.3624 5.9675C10.4322 5.89789 10.515 5.84272 10.6062 5.80513C10.6973 5.76755 10.7949 5.7483 10.8935 5.74847C10.992 5.74865 11.0896 5.76825 11.1806 5.80615C11.2715 5.84405 11.3542 5.89952 11.4237 5.96938ZM15.1431 8C15.1431 9.33502 14.7472 10.6401 14.0055 11.7501C13.2638 12.8601 12.2096 13.7253 10.9762 14.2362C9.74278 14.7471 8.38558 14.8808 7.07621 14.6203C5.76684 14.3598 4.5641 13.717 3.6201 12.773C2.67609 11.829 2.03322 10.6262 1.77277 9.31686C1.51232 8.00749 1.64599 6.65029 2.15688 5.41689C2.66777 4.18349 3.53294 3.12928 4.64297 2.38758C5.753 1.64588 7.05805 1.25 8.39307 1.25C10.1827 1.25199 11.8984 1.96378 13.1638 3.22922C14.4293 4.49466 15.1411 6.2104 15.1431 8ZM13.6431 8C13.6431 6.96165 13.3352 5.94661 12.7583 5.08326C12.1814 4.2199 11.3615 3.54699 10.4022 3.14963C9.44284 2.75227 8.38725 2.6483 7.36884 2.85088C6.35044 3.05345 5.41498 3.55346 4.68076 4.28769C3.94653 5.02191 3.44652 5.95738 3.24395 6.97578C3.04137 7.99418 3.14534 9.04978 3.5427 10.0091C3.94006 10.9684 4.61297 11.7883 5.47633 12.3652C6.33968 12.9421 7.35472 13.25 8.39307 13.25C9.785 13.2485 11.1195 12.6949 12.1037 11.7107C13.088 10.7264 13.6416 9.39193 13.6431 8Z" fill="#06742B"/></svg>';
            }
        }
        
        console.log('Thinking complete');
        
        // Check if we should auto-advance after thinking is complete
        if (this.autoAdvanceAfterRender) {
            console.log('Thinking complete, auto-advancing to next step');
            this.autoAdvanceAfterRender = false;
            setTimeout(() => {
                this.currentStep++;
                this.processNextStep();
            }, 100);
        } else {
            // Default behavior - auto-advance after 1 second
            setTimeout(() => {
                this.currentStep++;
                this.processNextStep();
            }, 1000);
        }
    }
    
    async streamText(element, text) {
        console.log('Streaming to element:', element.id, 'Element found:', !!element);
        
        if (!element) {
            console.error('Element not found');
            return;
        }
        
        element.innerHTML = '';
        
        for (let i = 0; i < text.length; i++) {
            element.innerHTML += text[i];
            await this.delay(30); // Adjust speed as needed
        }
        
        console.log('Streaming complete for:', element.id);
    }
    
    
    delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    
    parseSystemCommands(htmlContent) {
        const commands = {
            render: 'stream', // Default to stream mode
            load: null,
            nextAction: null,
            suggestedResponse: null,
            autoAdvance: null,
            typingDelay: null
        };
        
        let cleanContent = htmlContent;
        
        // Parse JSON script tag for system commands
        const scriptRegex = /<script[^>]*id="system-commands"[^>]*>(.*?)<\/script>/s;
        const scriptMatch = htmlContent.match(scriptRegex);
        
        if (scriptMatch) {
            try {
                const scriptCommands = JSON.parse(scriptMatch[1]);
                console.log('Found JSON system commands:', scriptCommands);
                
                // Merge commands from JSON
                Object.assign(commands, scriptCommands);
                
                // Remove the script tag from content
                cleanContent = htmlContent.replace(scriptRegex, '');
            } catch (error) {
                console.error('Error parsing JSON system commands:', error);
            }
        }
        
        // Parse data attributes from hidden div (backward compatibility)
        const dataAttrRegex = /<div[^>]*data-render="([^"]*)"[^>]*data-next-action="([^"]*)"[^>]*data-suggested-response="([^"]*)"[^>]*>/;
        const dataMatch = htmlContent.match(dataAttrRegex);
        
        if (dataMatch) {
            console.log('Found data attributes:', dataMatch);
            commands.render = dataMatch[1] || 'stream';
            commands.nextAction = dataMatch[2] || null;
            commands.suggestedResponse = dataMatch[3] || null;
            
            // Remove the data div from content
            cleanContent = htmlContent.replace(/<div[^>]*data-render[^>]*><\/div>\s*/, '');
        }
        
        // Also parse HTML comments for system commands (backward compatibility)
        const commentRegex = /<!--\s*([A-Z-]+):\s*(.*?)\s*-->/g;
        let match;
        
        while ((match = commentRegex.exec(htmlContent)) !== null) {
            const [, command, value] = match;
            const cleanValue = value.trim();
            
            switch (command) {
                case 'RENDER':
                    commands.render = cleanValue.toLowerCase();
                    break;
                case 'LOAD':
                    commands.load = cleanValue;
                    break;
                case 'NEXT-ACTION':
                    commands.nextAction = cleanValue.toLowerCase();
                    break;
                case 'SUGGESTED-RESPONSE':
                    commands.suggestedResponse = cleanValue;
                    break;
                case 'AUTO-ADVANCE':
                    commands.autoAdvance = parseInt(cleanValue) || 1000;
                    break;
                case 'TYPING-DELAY':
                    commands.typingDelay = parseInt(cleanValue) || 50;
                    break;
            }
            
            // Remove the comment from the content
            cleanContent = cleanContent.replace(match[0], '');
        }
        
        console.log('Parsed system commands:', commands);
        return { cleanContent, commands };
    }
    
    async handleSystemCommands(commands) {
        // Handle load command - load PHP content into emoji container
        if (commands.load) {
            console.log('Loading content into emoji container:', commands.load);
            await this.loadContentIntoEmojiContainer(commands.load);
        }
        
        // Handle suggested response - populate input field immediately
        if (commands.suggestedResponse) {
            console.log('Populating input with suggested response:', commands.suggestedResponse);
            setTimeout(() => {
                this.userInput.value = commands.suggestedResponse;
                this.userInput.disabled = false;
                this.sendButton.disabled = false;
                this.userInput.focus();
            }, 500);
        }
        
        // Handle next action
        if (commands.nextAction === 'proceed-after-render') {
            // Auto-advance after rendering is complete
            this.autoAdvanceAfterRender = true;
        } else if (commands.nextAction && commands.nextAction.startsWith('proceed-after-')) {
            // Extract delay from nextAction (e.g., 'proceed-after-1000' = 1000ms)
            const delayMatch = commands.nextAction.match(/proceed-after-(\d+)/);
            const delay = delayMatch ? parseInt(delayMatch[1]) : 1000;
            setTimeout(() => {
                this.currentStep++;
                this.processNextStep();
            }, delay);
        } else if (commands.nextAction === 'wait') {
            // Wait for user input (default behavior)
            // Input field is already populated above if suggestedResponse exists
        }
    }
    
    async loadContentIntoEmojiContainer(filePath) {
        const emojiSection = document.querySelector('.emoji-section');
        if (!emojiSection) {
            console.error('Emoji section not found');
            return;
        }
        
        try {
            console.log('Loading content from:', filePath);
            const response = await fetch(filePath);
            if (!response.ok) {
                throw new Error(`Failed to load ${filePath}`);
            }
            
                const html = await response.text();
                emojiSection.innerHTML = html;
                
            // Execute any scripts in the loaded content
            const scripts = emojiSection.querySelectorAll('script');
            scripts.forEach(script => {
                const newScript = document.createElement('script');
                if (script.src) {
                    newScript.src = script.src;
                } else {
                    newScript.textContent = script.textContent;
                }
                document.head.appendChild(newScript);
                document.head.removeChild(newScript);
            });
            
            // Load and execute the candidate selection script if it exists
                this.loadCandidateSelectionScript();
                
                // Update selection bar position now that candidate cards are loaded
                this.updateSelectionBarPosition();
            
            console.log('Content loaded successfully into emoji container');
            } catch (error) {
            console.error('Error loading content into emoji container:', error);
            emojiSection.innerHTML = '<p>Error loading content. Please try again.</p>';
        }
    }
    
    autoPopulateInput(suggestedResponse = null) {
        // Check if the next step is a user input step
        if (this.currentStep < this.conversationSteps.length) {
            const nextStep = this.conversationSteps[this.currentStep];
            
            if (nextStep.type === 'user') {
                // Load user response from HTML file if available
                if (nextStep.file) {
                    try {
                        fetch(`conversations/${this.conversationId}/${nextStep.file}`)
                            .then(response => response.ok ? response.text() : null)
                            .then(userResponse => {
                                if (userResponse) {
                                    setTimeout(() => {
                                        this.userInput.value = userResponse.trim();
                                        this.userInput.disabled = false;
                                        this.sendButton.disabled = false;
                                        this.userInput.focus();
                                        
                                        if (nextStep.placeholder) {
                                            this.userInput.placeholder = nextStep.placeholder;
                                        }
                                    }, 500);
                                }
                            })
                            .catch(error => console.error('Error loading user response:', error));
                    } catch (error) {
                        console.error('Error loading user response:', error);
                    }
                }
                // Use suggested response if provided
                else if (suggestedResponse) {
                    setTimeout(() => {
                        this.userInput.value = suggestedResponse;
                        this.userInput.disabled = false;
                        this.sendButton.disabled = false;
                        this.userInput.focus();
                        
                        if (nextStep.placeholder) {
                            this.userInput.placeholder = nextStep.placeholder;
                        }
                    }, 500);
                }
            }
        }
    }
    
    loadCandidateSelectionScript() {
        console.log('Loading candidate selection functionality...');
        
        // Define the initialization function directly here
        window.initializeCandidateSelection = function() {
            console.log('Initializing candidate selection...');
            
            const checkboxes = document.querySelectorAll('.candidate-checkbox');
            const selectionBar = document.getElementById('selectionBar');
            const selectionCount = document.getElementById('selectionCount');
            const candidateCards = document.querySelectorAll('.candidate-card');
            
            console.log('Found elements:', {
                checkboxes: checkboxes.length,
                selectionBar: !!selectionBar,
                selectionCount: !!selectionCount,
                candidateCards: candidateCards.length
            });
            
            if (checkboxes.length === 0) {
                console.log('No checkboxes found, retrying in 100ms...');
                setTimeout(window.initializeCandidateSelection, 100);
                return;
            }
            
            function updateSelection() {
                const checkedBoxes = document.querySelectorAll('.candidate-checkbox:checked');
                const count = checkedBoxes.length;
                const totalCount = checkboxes.length;
                const selectAllCheckbox = document.getElementById('selectAllCheckbox');
                
                // Update selection count text
                if (count === 0) {
                    selectionCount.textContent = 'Select all';
                } else if (count === totalCount) {
                    selectionCount.textContent = 'All selected';
                } else {
                    selectionCount.textContent = count === 1 ? '1 selected' : `${count} selected`;
                }
                
                // Update select all checkbox state
                if (selectAllCheckbox) {
                    if (count === 0) {
                        selectAllCheckbox.checked = false;
                        selectAllCheckbox.indeterminate = false;
                    } else if (count === totalCount) {
                        selectAllCheckbox.checked = true;
                        selectAllCheckbox.indeterminate = false;
                    } else {
                        selectAllCheckbox.checked = false;
                        selectAllCheckbox.indeterminate = true;
                    }
                }
                
                // Update card visual states
                candidateCards.forEach((card, index) => {
                    const checkbox = card.querySelector('.candidate-checkbox');
                    if (checkbox.checked) {
                        card.classList.add('selected');
                    } else {
                        card.classList.remove('selected');
                    }
                });
            }
            
            // Add event listeners to checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelection);
            });
            
            // Add event listener to select all checkbox
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const isChecked = this.checked;
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });
                    updateSelection();
                });
            }
            
            // Add click handlers to candidate cards for easier selection
            candidateCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't trigger if clicking on the checkbox itself
                    if (e.target.classList.contains('candidate-checkbox')) {
                        return;
                    }
                    
                    const checkbox = card.querySelector('.candidate-checkbox');
                    checkbox.checked = !checkbox.checked;
                    updateSelection();
                });
            });
            
            // Action button handlers
            const viewInPeopleBtn = document.getElementById('viewInPeopleBtn');
            if (viewInPeopleBtn) {
                viewInPeopleBtn.addEventListener('click', function() {
                    const selectedIds = Array.from(document.querySelectorAll('.candidate-checkbox:checked'))
                        .map(checkbox => checkbox.id);
                    console.log('View in People:', selectedIds);
                    // Add your View in People logic here
                });
            } else {
                console.log('viewInPeopleBtn not found');
            }
            
            // Dropdown functionality
            const addToBtn = document.getElementById('addToBtn');
            const dropdown = document.getElementById('addToDropdown');
            
            if (addToBtn && dropdown) {
                addToBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('show');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target) && !addToBtn.contains(e.target)) {
                        dropdown.classList.remove('show');
                    }
                });
                
                // Handle dropdown item clicks
                document.querySelectorAll('.dropdown-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const action = this.getAttribute('data-action');
                        const selectedIds = Array.from(document.querySelectorAll('.candidate-checkbox:checked'))
                            .map(checkbox => checkbox.id);
                        
                        console.log(`Add to ${action}:`, selectedIds);
                        
                        // Hide dropdown after selection
                        dropdown.classList.remove('show');
                        
                        // Add your specific logic for each action here
                        switch(action) {
                            case 'pool':
                                // Handle add to pool
                                break;
                            case 'vacancy':
                                // Handle add to vacancy
                                break;
                            case 'campaign':
                                // Handle add to campaign
                                break;
                            case 'message':
                                // Handle send message
                                break;
                        }
                    });
                });
            } else {
                console.log('Dropdown elements not found:', {
                    addToBtn: !!addToBtn,
                    dropdown: !!dropdown
                });
            }
        };
        
        // Call the initialization function
        setTimeout(() => {
            window.initializeCandidateSelection();
        }, 100);
    }

}

// Initialize the chat system when the page loads
document.addEventListener('DOMContentLoaded', () => {
    window.chatSystem = new ChatSystem();
});

// Add CSS for suggestions
const style = document.createElement('style');
style.textContent = `
.suggestions-container {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 8px;
}

.suggestion-button {
    padding: 8px 16px;
    background-color: var(--bg-secondary);
    color: var(--text-primary);
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.suggestion-button:hover {
    background-color: var(--bg-tertiary);
}

.suggestion-button:active {
    background-color: var(--text-muted);
}
`;
document.head.appendChild(style);
