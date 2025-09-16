# Work Portfolio - Encosion.com

A collection of interactive web applications and prototypes showcasing modern web development techniques.

## Projects

### Chat Prototype - Recruitment Assistant
An interactive chat simulation demonstrating a realistic job sourcing conversation for Senior Product Owner roles.

**Features:**
- **Interactive Chat Interface**: Realistic conversation flow with typing indicators and auto-populated responses
- **Dynamic Candidate Table**: Shows 15 Senior Product Owner candidates with loading spinner
- **Responsive Design**: Works on desktop and mobile devices
- **Cache-Busting**: Development-friendly with automatic cache invalidation
- **Scrollable Results**: Candidate table with smooth scrolling

## Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP
- **Styling**: Custom CSS with CSS Variables
- **Data**: JSON configuration files

## File Structure

```
work/
├── index.html             # Main work portfolio page
├── chat/                  # Chat prototype application
│   ├── index.php         # Main chat interface
│   ├── chat.js           # Chat system JavaScript
│   ├── style.css         # Styling and responsive design
│   ├── list_files.php    # Conversation file loader
│   ├── .htaccess         # Cache control for development
│   ├── conversations/    # Conversation data
│   │   ├── recruitment_1.0/  # Original conversation
│   │   ├── recruitment_1.1/  # Updated conversation with table
│   │   ├── recruitment_1.1.2/ # Additional conversation variant
│   │   └── recruitment_1.1.3/ # Additional conversation variant
│   └── images/           # Chat interface assets
└── README.md             # This file
```

## Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/encosion/work.encosion.com.git
   cd work.encosion.com
   ```

2. **Configure web server**:
   - Ensure PHP is enabled
   - Point document root to the work directory
   - Enable mod_rewrite for .htaccess support

3. **Access the applications**:
   - **Main Portfolio**: `https://work.encosion.com/`
   - **Chat Prototype**: `https://work.encosion.com/chat/`
   - **Chat with specific conversation**: `https://work.encosion.com/chat/?conversation=recruitment_1.1`

## Development

### Cache Busting
The application includes automatic cache-busting for rapid development:
- Version parameters on CSS/JS files
- PHP headers to disable caching
- .htaccess rules for server-level cache control

### Adding New Conversations
1. Create a new directory in `conversations/`
2. Add `config.json` with conversation settings
3. Create `step_*.md` files for the conversation flow
4. Update the conversation ID in the URL

## Features in Detail

### Chat System
- **Typing Indicators**: Realistic typing animation
- **Auto-population**: User responses auto-filled from markdown files
- **Message Streaming**: Progressive text reveal with configurable delays
- **Responsive Design**: Mobile-friendly interface

### Candidate Table
- **Loading Spinner**: Shows during last agent message
- **15 Candidates**: Senior Product Owner profiles with job history
- **Scrollable**: Smooth scrolling through candidate cards
- **Responsive**: Adapts to different screen sizes

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## License

This project is part of the encosion.com work portfolio.