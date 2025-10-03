# Ray - AI-Powered Recruitment Sourcing Assistant

Ray is an interactive chat-based prototype for an AI-powered recruitment sourcing assistant. It simulates conversations between recruiters and an AI agent that helps find and evaluate candidates using a sophisticated "Narrow to Broad" search strategy.

## 🎯 Overview

Ray demonstrates how AI can assist recruiters in the candidate sourcing process by:

- **Interactive Chat Interface**: Simulates real-time conversations with typing animations and streaming responses
- **Multi-Level Search Strategy**: Implements "Exact", "Close", and "Broad" search approaches that progressively widen candidate pools
- **Dynamic Candidate Selection**: Interactive candidate cards with selection capabilities and bulk actions
- **Conversation Management**: Modular conversation system with configurable user profiles and scenarios

## ✨ Key Features

### 🤖 AI Chat Interface
- **Streaming Responses**: Real-time message streaming with typing animations
- **Dynamic User Names**: Personalized conversations with configurable user profiles
- **Suggested Responses**: AI-provided response suggestions to guide user interactions
- **Conversation Reset**: Ability to restart conversations and load different scenarios

### 🔍 Advanced Search Strategy
- **Three-Tier Search Approach**:
  - **Exact**: Same job role with title variations
  - **Close**: Close job role variations within the same industry
  - **Broad**: All related roles with skill compositions
- **Smart Filtering**: Job titles, skills, and company buckets for targeted searches
- **Progressive Scope**: Searches that start narrow and expand systematically

### 👥 Candidate Management
- **Interactive Selection**: Checkbox-based candidate selection with bulk actions
- **Selection Counter**: Real-time count of selected candidates
- **Select All/None**: Quick selection controls for efficiency
- **Candidate Cards**: Rich candidate profiles with key information

### 🎨 Modern UI/UX
- **Beamery Design System**: Consistent branding and color scheme
- **Responsive Design**: Adaptive layouts
- **Smooth Animations**: CSS transitions and micro-interactions
- **Accessibility**: Proper ARIA labels and keyboard navigation support

## 🏗️ Project Structure

```
ray/
├── index.php                 # Main application entry point
├── app.js                   # Core chat system JavaScript
├── candidate-selection.js   # Candidate selection functionality
├── style.css               # Main stylesheet with Beamery design system
├── list_files.php          # API endpoint for conversation file listing
├── .htaccess               # Apache configuration
├── includes/                # Reusable PHP components
│   ├── header.php          # Top navigation header
│   ├── navigation.php      # Side navigation menu
│   ├── filters.php         # Search filter components
│   ├── loading-spinner.php # Loading animation
│   └── results-layout.php  # Search results layout
├── conversations/          # Conversation scenarios
│   ├── product-owner/      # Product Owner recruitment scenario
│   │   ├── config.json     # User configuration
│   │   ├── *.php           # Conversation step files
│   │   └── results-*.json  # Search result data
│   └── centene/            # Centene recruitment scenario
│       ├── config.json     # User configuration
│       ├── *.php           # Conversation step files
│       └── *.json          # Search result data
├── images/                 # Assets and icons
│   ├── logo-ray.svg        # Ray logo
│   ├── logo-beamery.svg    # Beamery logo
│   ├── icon-*.svg          # UI icons
│   └── favicon files       # Browser icons
└── screenshots/            # Documentation screenshots
    └── Narrow-to-Broad-search.md
```

## 🚀 Getting Started

### Prerequisites
- **Web Server**: Apache or Nginx with PHP support
- **PHP**: Version 7.4 or higher
- **Modern Browser**: Chrome, Firefox, Safari, or Edge with JavaScript enabled

### Installation

1. **Clone or Download** the project files to your web server directory
2. **Configure Web Server** to serve PHP files (Apache `.htaccess` included)
3. **Set Permissions** to ensure PHP can read conversation files
4. **Access the Application** via your web browser

### Quick Start

1. Navigate to `index.php` in your browser
2. The application will load the default conversation (`recruitment_1.1`)
3. Use the conversation parameter to load different scenarios:
   - `?conversation=product-owner` - Product Owner recruitment scenario
   - `?conversation=centene` - Centene recruitment scenario

## 💬 Conversation System

### How It Works

Ray uses a modular conversation system where each interaction is stored as a separate PHP file:

```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'stream',
    'nextAction' => 'wait',
    'suggestedResponse' => 'I\'m looking for Product Owners near Wilmington, NC',
    'typingDelay' => 10
];
?>
<p>Hi <span class="dynamic-user-name">{{USER_NAME}}</span>,</p>
<p>I'm a sourcing assistant. I want to help you find the best prospects for your roles.</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

### System Commands

Each conversation step can include system commands:

- **`render`**: How to display the message (`stream`, `appear`)
- **`nextAction`**: What happens after rendering (`wait`, `proceed-after-render`)
- **`suggestedResponse`**: Suggested user response text to populate the chat input to assist in testing
- **`typingDelay`**: Delay between characters when streaming

### Configuration

User profiles are configured via `config.json` files:

```json
{
    "user_name": "Andrew"
}
```

## 🔍 Search Strategy Implementation

### Narrow to Broad Approach

Ray implements a sophisticated three-tier search strategy:

| Search Type | Description | Job Titles | Skills | Companies |
|-------------|-------------|------------|--------|-----------|
| **Exact** | Same job role with title variations | Role Bucket 1 | Must-Have | Company Bucket 1+2 |
| **Close** | Close job role variations | Role Bucket 2 | Must-Have | Company Bucket 1+2 |
| **Broad** | All related roles, skill compositions | N/A | Must-Have | N/A |

### Job Title Buckets

- **Bucket 1**: True job title synonyms (tight scope)
- **Bucket 2**: Job role variations within same industry/sector

### Skills Classification

- **⭐ Must-Have**: Fundamental skills for the role
- **✅ Strongly Preferred**: Important but not essential skills
- **🎉 Nice-to-Have**: Additional beneficial skills

### Company Targeting

- **Bucket 1**: Direct competitors and same niche companies
- **Bucket 2**: Adjacent companies in the same ecosystem

## 🎨 Design System

Ray uses the Beamery design system with:

- **Color Palette**: Professional blues, purples, and grays
- **Typography**: Inter font family for modern readability
- **Components**: Consistent buttons, inputs, and cards
- **Animations**: Smooth transitions and micro-interactions

### Key CSS Variables

```css
:root {
    --accent: #492FF4;
    --text-primary: #1F1F23;
    --bg-default: #F6F6F7;
    --agent-bubble: #ffffff;
    --user-bubble: #492FF4;
}
```

## 🔧 Customization

### Adding New Conversations

1. Create a new directory in `conversations/`
2. Add a `config.json` file with user settings
3. Create conversation step files (`.php`)
4. Add search result data files (`.json`)
5. Access via `?conversation=your-conversation-name`

### Modifying Search Logic

- Update `candidate-selection.js` for selection behavior
- Modify `includes/filters.php` for search criteria
- Edit conversation step files for different search strategies

### Styling Changes

- Update `style.css` for visual modifications
- Modify CSS variables for color scheme changes
- Add new components in `includes/` directory

## 📱 Browser Support

- **Chrome**: 90+
- **Firefox**: 88+
- **Safari**: 14+
- **Edge**: 90+

## 🤝 Contributing

This is a prototype demonstration project. For production use:

1. Implement proper authentication
2. Add database integration for real candidate data
3. Implement actual AI/ML search algorithms
4. Add comprehensive error handling
5. Include unit tests and documentation

## 📄 License

This project is a prototype demonstration. Please ensure proper licensing for any production use.

---

*Ray demonstrates the future of AI-assisted recruitment, combining intelligent search strategies with intuitive user interfaces to streamline the candidate sourcing process.*

