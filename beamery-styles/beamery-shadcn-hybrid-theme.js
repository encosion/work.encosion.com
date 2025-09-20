// Beamery-Shadcn Hybrid Theme Reference  
// All design tokens as Tailwind classes for v0/Claude Desktop compatibility

export const BEAMERY_HYBRID_THEME = {
  // Setup for local development
  setup: {
    import: `import { Button, Card, Stack, Input, Heading, Paragraph } from "beamery-design-system-hybrid-beta"`,
    
    // For v0/Claude Desktop - no imports needed, just use classes
    v0Usage: `
<!-- No imports required - just use the Tailwind classes below -->
<div className="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
  <h1 className="text-2xl font-bold text-[#1F1F23] mb-4">Beamery Component</h1>
  <button className="bg-[#492FF4] hover:bg-[#391EE6] text-white px-6 py-3 rounded-md">
    Primary Button
  </button>
</div>
    `
  },

  // Color System - Exact Beamery Colors as Tailwind Classes
  colors: {
    // Brand Colors
    brand: {
      navy: "#150E3F",
      deepLavender: "#7E4BBC", 
      orange: "#F15852",
      primary: "#492FF4",      // Main brand color
      primaryHover: "#391EE6",
      primaryActive: "#2222C3"
    },
    
    // Neutrals (Beamery Gray Scale)
    neutrals: {
      900: "#1F1F23",  // Darkest text
      800: "#484851",
      750: "#5B5B67",
      700: "#6C6C7A",  // Secondary text
      600: "#A0A0AB",
      500: "#BCBCC3",
      400: "#DBDBE0",  // Borders, hover states
      300: "#E7E7E9",
      200: "#F1F1F3",  // Light backgrounds
      100: "#F6F6F7",
      0: "#FFFFFF"     // White
    },
    
    // Semantic Colors
    semantic: {
      success: "#06742B",
      successHover: "#095D25",
      successActive: "#064C1D",
      successLight: "#E6F7ED",
      
      error: "#BF0338",
      errorHover: "#9E002D", 
      errorActive: "#860329",
      errorLight: "#FFE6E9",
      
      warning: "#F59E0B",
      warningLight: "#FEF3C7",
      
      info: "#3B82F6",
      infoLight: "#DBEAFE"
    },
    
    // Button-specific colors
    buttons: {
      primary: {
        bg: "#492FF4",
        hover: "#391EE6",
        active: "#2222C3",
        text: "#FFFFFF",
        shadow: "rgba(73, 47, 244, 0.31)"
      },
      secondary: {
        bg: "#F1F1F3",
        hover: "#DBDBE0",
        active: "#BCBCC3",
        text: "#1F1F23"
      },
      activation: {
        bg: "#06742B",
        hover: "#095D25", 
        active: "#064C1D",
        text: "#FFFFFF",
        shadow: "rgba(6, 116, 43, 0.31)"
      },
      destructive: {
        bg: "#BF0338",
        hover: "#9E002D",
        active: "#860329", 
        text: "#FFFFFF",
        shadow: "rgba(191, 3, 56, 0.31)"
      }
    }
  },

  // Typography System
  typography: {
    // Font families
    fontFamily: {
      default: "'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif"
    },
    
    // Headings with exact Beamery sizes
    headings: {
      h1: {
        class: "text-2xl font-bold text-[#1F1F23]",
        size: "24px",
        weight: "700",
        color: "#1F1F23",
        usage: "Page titles, main headings"
      },
      h2: {
        class: "text-xl font-bold text-[#1F1F23]",
        size: "20px", 
        weight: "700",
        color: "#1F1F23",
        usage: "Section titles"
      },
      h3: {
        class: "text-xl font-bold text-[#1F1F23]",
        size: "20px",
        weight: "700", 
        color: "#1F1F23",
        usage: "Subsection titles"
      },
      h4: {
        class: "text-sm font-bold text-[#1F1F23]",
        size: "14px",
        weight: "700",
        color: "#1F1F23",
        usage: "Small section headers"
      },
      h5: {
        class: "text-xs font-bold text-[#1F1F23] uppercase tracking-wide",
        size: "12px",
        weight: "700",
        color: "#1F1F23",
        usage: "Group titles, labels"
      },
      h6: {
        class: "text-xs font-bold text-[#1F1F23]",
        size: "12px",
        weight: "700",
        color: "#1F1F23", 
        usage: "Smallest headings"
      }
    },
    
    // Body text variants
    body: {
      default: {
        class: "text-sm text-[#1F1F23] leading-relaxed",
        size: "14px",
        color: "#1F1F23",
        lineHeight: "1.6"
      },
      emphasised: {
        class: "text-sm text-[#1F1F23] font-medium leading-relaxed",
        size: "14px",
        color: "#1F1F23",
        weight: "500"
      },
      compact: {
        class: "text-sm text-[#1F1F23] leading-tight",
        size: "14px",
        color: "#1F1F23",
        lineHeight: "1.4"
      },
      small: {
        class: "text-xs text-[#1F1F23] leading-relaxed",
        size: "12px",
        color: "#1F1F23"
      },
      secondary: {
        class: "text-sm text-[#6C6C7A] leading-relaxed",
        size: "14px",
        color: "#6C6C7A",
        usage: "Secondary information, descriptions"
      }
    },
    
    // Specialized text
    text: {
      control: {
        class: "text-sm text-[#1F1F23]",
        usage: "Form controls, buttons"
      },
      input: {
        class: "text-sm text-[#1F1F23] placeholder:text-[#A0A0AB]",
        usage: "Input fields"
      },
      label: {
        class: "text-sm font-medium text-[#1F1F23]",
        usage: "Form labels"
      },
      link: {
        class: "text-sm text-[#492FF4] hover:text-[#391EE6] cursor-pointer",
        usage: "Clickable links"
      },
      error: {
        class: "text-sm text-[#BF0338]",
        usage: "Error messages"
      },
      success: {
        class: "text-sm text-[#06742B]",
        usage: "Success messages"
      }
    }
  },

  // Spacing System - Beamery's 4px grid
  spacing: {
    // Beamery spacing scale
    beamery: {
      x0: "0px",      // 0
      x1: "4px",      // 0.25rem
      x2: "8px",      // 0.5rem  
      x3: "12px",     // 0.75rem
      x4: "16px",     // 1rem - most common
      x6: "24px",     // 1.5rem
      x10: "40px",    // 2.5rem
      x18: "72px"     // 4.5rem
    },
    
    // Tailwind classes for gaps
    gaps: {
      x0: "gap-0",
      x1: "gap-1",
      x2: "gap-2", 
      x3: "gap-3",
      x4: "gap-4",    // Most common
      x6: "gap-6",
      x10: "gap-10",
      x18: "gap-18"
    },
    
    // Tailwind classes for padding
    padding: {
      x0: "p-0",
      x1: "p-1",
      x2: "p-2",
      x3: "p-3", 
      x4: "p-4",      // Card padding small
      x6: "p-6",      // Card padding default
      x10: "p-10",
      x18: "p-18"
    },
    
    // Tailwind classes for margin
    margin: {
      x0: "m-0",
      x1: "m-1",
      x2: "m-2",
      x3: "m-3",
      x4: "m-4",
      x6: "m-6",
      x10: "m-10", 
      x18: "m-18"
    }
  },

  // Component Styles - Ready-to-use Tailwind classes
  components: {
    // Cards
    card: {
      base: "bg-white rounded-lg border border-gray-200 shadow-sm",
      paddingX4: "p-4",
      paddingX6: "p-6",
      full: "bg-white rounded-lg border border-gray-200 shadow-sm p-6"
    },
    
    // Buttons - Complete button styles
    button: {
      // Base styles - CORRECT Beamery sizing
      base: "inline-flex items-center justify-center h-10 px-4 py-2 rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed",
      
      // Variants
      primary: "bg-[#492FF4] hover:bg-[#391EE6] active:bg-[#2222C3] text-white focus:ring-[#492FF4] shadow-[0_2px_4px_rgba(73,47,244,0.31)]",
      secondary: "bg-[#F1F1F3] hover:bg-[#DBDBE0] active:bg-[#BCBCC3] text-[#1F1F23] focus:ring-[#DBDBE0]",
      subtle: "bg-transparent hover:bg-[#DBDBE0] active:bg-[#BCBCC3] text-[#1F1F23] focus:ring-[#DBDBE0]",
      activation: "bg-[#06742B] hover:bg-[#095D25] active:bg-[#064C1D] text-white focus:ring-[#06742B] shadow-[0_2px_4px_rgba(6,116,43,0.31)]",
      primaryDestructive: "bg-[#BF0338] hover:bg-[#9E002D] active:bg-[#860329] text-white focus:ring-[#BF0338] shadow-[0_2px_4px_rgba(191,3,56,0.31)]",
      secondaryDestructive: "bg-[#FFE6E9] hover:bg-[#FFE6E9] text-[#BF0338] focus:ring-[#BF0338]",
      subtleDestructive: "bg-transparent hover:bg-[#BF0338] hover:text-white text-[#BF0338] focus:ring-[#BF0338]",
      
      // Sizes - CORRECT Beamery sizing
      small: "h-9 px-3 text-sm",
      default: "h-10 px-4 py-2 text-sm", 
      large: "h-11 px-8 text-sm",
      
      // Modifiers
      fullWidth: "w-full",
      iconOnly: "p-3"
    },
    
    // Inputs
    input: {
      base: "w-full px-3 py-2 border rounded-md transition-colors placeholder:text-[#A0A0AB] focus:outline-none focus:ring-2 focus:ring-offset-0",
      default: "border-gray-300 focus:ring-[#492FF4] focus:border-[#492FF4]",
      error: "border-red-500 focus:ring-red-500 focus:border-red-500",
      success: "border-green-500 focus:ring-green-500 focus:border-green-500",
      disabled: "bg-gray-50 cursor-not-allowed opacity-50"
    },
    
    // Form elements
    form: {
      wrapper: "space-y-2",
      label: "block text-sm font-medium text-[#1F1F23]",
      required: "text-red-500",
      description: "text-sm text-[#6C6C7A] mt-1",
      error: "text-sm text-[#BF0338] mt-1",
      success: "text-sm text-[#06742B] mt-1"
    },
    
    // Layout
    layout: {
      // Stack/Flex
      stackColumn: "flex flex-col",
      stackRow: "flex flex-row",
      
      // Common layouts
      pageContainer: "max-w-6xl mx-auto p-6",
      centerContent: "min-h-screen flex items-center justify-center",
      formContainer: "max-w-md mx-auto",
      
      // Backgrounds
      pageBackground: "min-h-screen bg-gray-50",
      cardBackground: "bg-white"
    }
  },

  // Preset Combinations - Complete component classes
  presets: {
    // Buttons - CORRECT Beamery sizing
    primaryButton: "inline-flex items-center justify-center h-10 px-4 py-2 rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed bg-[#492FF4] hover:bg-[#391EE6] active:bg-[#2222C3] text-white focus:ring-[#492FF4] shadow-[0_2px_4px_rgba(73,47,244,0.31)]",
    
    secondaryButton: "inline-flex items-center justify-center h-10 px-4 py-2 rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed bg-[#F1F1F3] hover:bg-[#DBDBE0] active:bg-[#BCBCC3] text-[#1F1F23] focus:ring-[#DBDBE0]",
    
    destructiveButton: "inline-flex items-center justify-center h-10 px-4 py-2 rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed bg-[#BF0338] hover:bg-[#9E002D] active:bg-[#860329] text-white focus:ring-[#BF0338] shadow-[0_2px_4px_rgba(191,3,56,0.31)]",
    
    // Inputs
    textInput: "w-full px-3 py-2 border rounded-md transition-colors placeholder:text-[#A0A0AB] focus:outline-none focus:ring-2 focus:ring-offset-0 border-gray-300 focus:ring-[#492FF4] focus:border-[#492FF4]",
    
    errorInput: "w-full px-3 py-2 border rounded-md transition-colors placeholder:text-[#A0A0AB] focus:outline-none focus:ring-2 focus:ring-offset-0 border-red-500 focus:ring-red-500 focus:border-red-500",
    
    // Cards
    defaultCard: "bg-white rounded-lg border border-gray-200 shadow-sm p-6",
    compactCard: "bg-white rounded-lg border border-gray-200 shadow-sm p-4",
    
    // Typography
    pageTitle: "text-2xl font-bold text-[#1F1F23]",
    sectionTitle: "text-xl font-bold text-[#1F1F23]", 
    formLabel: "block text-sm font-medium text-[#1F1F23]",
    bodyText: "text-sm text-[#1F1F23] leading-relaxed",
    secondaryText: "text-sm text-[#6C6C7A] leading-relaxed",
    linkText: "text-sm text-[#492FF4] hover:text-[#391EE6] cursor-pointer",
    errorText: "text-sm text-[#BF0338]",
    
    // Layout
    pageLayout: "min-h-screen bg-gray-50",
    contentContainer: "max-w-6xl mx-auto p-6",
    formLayout: "min-h-screen flex items-center justify-center bg-gray-50 p-4",
    cardLayout: "bg-white rounded-lg border border-gray-200 shadow-sm p-6 w-full max-w-md",
    
    // Stacks
    verticalStack: "flex flex-col gap-4",
    horizontalStack: "flex flex-row gap-4",
    formStack: "flex flex-col gap-6",
    buttonStack: "flex flex-row gap-3"
  },

  // Responsive breakpoints
  breakpoints: {
    sm: "640px",
    md: "768px", 
    lg: "1024px",
    xl: "1280px",
    "2xl": "1536px"
  },

  // Shadows
  shadows: {
    card: "0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)",
    button: "0 2px 4px rgba(0, 0, 0, 0.1)",
    primaryButton: "0 2px 4px rgba(73, 47, 244, 0.31)",
    destructiveButton: "0 2px 4px rgba(191, 3, 56, 0.31)",
    activationButton: "0 2px 4px rgba(6, 116, 43, 0.31)"
  }
}

// Utility functions for v0/Claude Desktop
export const getBeameryClass = (component, variant = 'default') => {
  return BEAMERY_HYBRID_THEME.presets[`${component}${variant.charAt(0).toUpperCase() + variant.slice(1)}`] || 
         BEAMERY_HYBRID_THEME.presets[component] || 
         ''
}

export const getBeameryColors = () => BEAMERY_HYBRID_THEME.colors

export const getBeamerySpacing = () => BEAMERY_HYBRID_THEME.spacing

export const getBeameryTypography = () => BEAMERY_HYBRID_THEME.typography