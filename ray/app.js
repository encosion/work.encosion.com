/**
 * Chat Prototype JavaScript
 * Handles the interactive chat simulation with markdown file streaming
 */

class ChatSystem {
    constructor() {
        this.conversationId = null;
        this.config = null;
        this.currentStep = 0;
        this.conversationSteps = [];
        this.isTyping = false;
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
        if (this.conversationSteps.length === 0) {
            this.showErrorMessage('No conversation steps found.');
            return;
        }

        this.currentStep = 0;
        await this.processNextStep();
    }

    async processNextStep() {
        if (this.currentStep >= this.conversationSteps.length) {
            this.showConversationComplete();
            return;
        }

        const step = this.conversationSteps[this.currentStep];
        
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
    }

    async showAgentMessage(step) {
        this.isTyping = true;
        this.showTypingIndicator();

        try {
            // Check if this is the last agent message in the conversation
            const isLastAgentMessage = this.isLastAgentMessage();
            if (isLastAgentMessage) {
                // Show loading spinner in emoji section
                this.showLoadingSpinner();
            }

            // Load markdown content
            const response = await fetch(`conversations/${this.conversationId}/${step.file}`);
            if (!response.ok) {
                throw new Error(`Failed to load ${step.file}`);
            }
            
            const markdownContent = await response.text();
            const htmlContent = this.parseMarkdown(markdownContent);
            
            // Remove typing indicator
            this.hideTypingIndicator();
            
            // Show message with typing effect
            await this.typeMessage(htmlContent, step.delay || 50);
            
            this.isTyping = false;
            this.currentStep++;
            
            // If this was the last agent message, replace spinner with table
            if (isLastAgentMessage) {
                this.replaceSpinnerWithTable();
            }
            
            // Auto-populate input field with first suggestion if available
            this.autoPopulateInput();
            
            // Auto-advance disabled - wait for user input
            
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

    async autoPopulateInput() {
        // Check if the next step is a user input step
        if (this.currentStep < this.conversationSteps.length) {
            const nextStep = this.conversationSteps[this.currentStep];
            
            if (nextStep.type === 'user') {
                // Load user response from markdown file if available
                if (nextStep.file) {
                    try {
                        const response = await fetch(`conversations/${this.conversationId}/${nextStep.file}`);
                        if (response.ok) {
                            const userResponse = await response.text();
                            
                            // Auto-populate with the content from markdown file
                            setTimeout(() => {
                                this.userInput.value = userResponse.trim();
                                this.userInput.disabled = false;
                                this.sendButton.disabled = false;
                                
                                // Auto-populated visual indicator removed
                                
                                this.userInput.focus();
                                
                                // Set placeholder if available
                                if (nextStep.placeholder) {
                                    this.userInput.placeholder = nextStep.placeholder;
                                }
                            }, 500); // Small delay to let the agent message settle
                        }
                    } catch (error) {
                        console.error('Error loading user response:', error);
                    }
                }
                // Fallback to suggestions if no file
                else if (nextStep.suggestions && nextStep.suggestions.length > 0) {
                    setTimeout(() => {
                        this.userInput.value = nextStep.suggestions[0];
                        this.userInput.disabled = false;
                        this.sendButton.disabled = false;
                        
                        // Auto-populated visual indicator removed
                        
                        this.userInput.focus();
                        
                        // Show suggestions
                        this.showSuggestions(nextStep.suggestions);
                        
                        // Set placeholder if available
                        if (nextStep.placeholder) {
                            this.userInput.placeholder = nextStep.placeholder;
                        }
                    }, 500);
                }
            }
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

    async typeMessage(content, delay = 50) {
        const messageElement = this.createMessageElement('agent', '');
        this.messageContainer.appendChild(messageElement);
        
        const contentElement = messageElement.querySelector('.message-content');
        
        // Simple typing effect - reveal content progressively
        const words = content.split(' ');
        let currentText = '';
        
        for (let i = 0; i < words.length; i++) {
            currentText += (i > 0 ? ' ' : '') + words[i];
            contentElement.innerHTML = currentText;
            
            // Scroll to bottom
            this.scrollToBottom();
            
            await this.sleep(delay);
        }
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
        indicatorDiv.innerHTML = '<span></span><span></span><span></span>';
        
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

    showConversationComplete() {
        this.addMessage('agent', '<strong>Conversation Complete!</strong><br>Click "Reset Conversation" to start over or "Load Example" to try a different scenario.');
    }

    isLastAgentMessage() {
        // Check if the current step is the last agent message in the conversation
        // Check if there are any more agent messages after the current one
        for (let i = this.currentStep + 1; i < this.conversationSteps.length; i++) {
            if (this.conversationSteps[i].type === 'agent') {
                return false; // There's another agent message after this one
            }
        }
        return true; // This is the last agent message
    }

    showLoadingSpinner() {
        const emojiSection = document.querySelector('.emoji-section');
        if (emojiSection) {
            emojiSection.innerHTML = `
                <div class="loading-container">
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                        <p>Loading candidates...</p>
                    </div>
                </div>
            `;
        }
    }

    async replaceSpinnerWithTable() {
        const emojiSection = document.querySelector('.emoji-section');
        if (emojiSection) {
            try {
                const response = await fetch('search_results.php');
                const html = await response.text();
                emojiSection.innerHTML = html;
                
                // Load and execute the candidate selection script
                this.loadCandidateSelectionScript();
            } catch (error) {
                console.error('Error loading search results:', error);
                emojiSection.innerHTML = '<p>Error loading search results. Please try again.</p>';
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
