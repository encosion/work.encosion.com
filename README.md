# Work Experiments

A collection of interactive web applications and prototypes showcasing modern web development techniques.

## Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP
- **Styling**: Custom CSS with CSS Variables
- **Data**: JSON configuration files

## File Structure

```
work/
├── index.html             # Main work portfolio page
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
3. Create sequential `*.php` files for the conversation flow
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