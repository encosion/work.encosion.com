# Ray Prototype - Agentic Sourcing Implementation Plan

## Project Overview
Interactive prototype based on Figma design for "Agentic Sourcing" search interface.
- **Location**: `/work/ray/` → `https://work.encosion.com/ray/`
- **Branch**: `feature/ray-prototype`
- **Figma**: [Agentic Sourcing Prototype](https://www.figma.com/design/QIGxRqRUDwUhJKCZOhVKrk/Agentic-Sourcing--2025--Search?node-id=13019-29974)

## Tech Stack (matching existing project)
- HTML5, CSS3, JavaScript (ES6+)
- PHP (if needed for data/routing)
- Custom CSS with CSS Variables
- JSON for configuration/data

## Design System (from Figma)
### Typography
- **Headings**: SF Pro Display (Bold/Heavy)
  - H1: 24px/800/36px line-height
  - H2: 20px/700/32px line-height
  - H3: 16px/700/24px line-height
  - H4: 14px/700/24px line-height
- **Body**: SF Pro Text
  - Regular: 14px/400/20px line-height
  - Compact: 14px/400/18px line-height
  - Small: 12px/400/20px line-height
- **UI Text**: SF Pro Text (Semibold 14px/600)
- **Titles**: Space Grotesk (Bold)
  - Title-2: 32px/700
  - Title-3: 24px/700

### Colors
- **Background**: `#F6F6F7`
- **Background Accent**: `#EBEBFE`
- **Background Warning**: `#FFF1C7`
- **Text Primary**: `#1F1F23`
- **Text Secondary**: `#6C6C7A`
- **Text On Dark**: `#FFFFFF`
- **Text Warning**: `#704D00`
- **Link Primary**: `#492FF4`
- **Control Secondary**: `#F1F1F3`
- **White**: `#FFFFFF`

## Implementation Tasks

### Phase 1: Setup & Structure ✅
- [x] Create `/work/ray/` directory
- [x] Create feature branch `feature/ray-prototype`
- [x] Create TODO.md planning document

### Phase 2: Core Files
- [ ] Create `index.html` or `index.php` (main interface)
- [ ] Create `style.css` (styling with design system variables)
- [ ] Create `app.js` (interactivity and state management)
- [ ] Create `.htaccess` (cache busting for development)

### Phase 3: Design System Implementation
- [ ] Set up CSS variables for colors
- [ ] Set up CSS variables for typography
- [ ] Create base typography classes
- [ ] Create layout grid/container system

### Phase 4: Component Development
Based on Figma prototype screens, likely components:
- [ ] Navigation/Header
- [ ] Search interface
- [ ] Chat/conversation interface
- [ ] Results/candidate display
- [ ] Filters/sidebar
- [ ] Loading states
- [ ] Empty states

### Phase 5: Interactivity
- [ ] Search functionality
- [ ] Chat message flow
- [ ] Results filtering/sorting
- [ ] Transitions and animations
- [ ] Responsive behavior

### Phase 6: Data & Configuration
- [ ] Create JSON configuration files
- [ ] Sample data structure
- [ ] PHP backend integration (if needed)

### Phase 7: Testing & Polish
- [ ] Cross-browser testing
- [ ] Mobile responsive testing
- [ ] Performance optimization
- [ ] Accessibility review

## Next Steps
1. Examine Figma prototype in detail to understand:
   - User flow and interaction patterns
   - Specific components needed
   - States and transitions
2. Build initial HTML structure
3. Implement CSS design system
4. Add JavaScript interactivity

## Notes
- Following existing project pattern (similar to `/work/chat/`)
- Maintain consistency with portfolio styling
- Focus on interactive prototype, not full production app
- Prioritize visual fidelity to Figma design
