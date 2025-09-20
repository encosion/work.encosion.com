// Beamery-Shadcn Hybrid Components Reference
// For v0/Claude Desktop artifact compatibility - NO imports required

export const BEAMERY_HYBRID_COMPONENTS = {
  // Layout & Structure
  Stack: {
    // Works in v0/Claude Desktop artifacts
    usage: `
<div className="flex flex-col gap-4">
  <div>Child 1</div>
  <div>Child 2</div>
</div>`,
    
    // Actual hybrid component API (for local development)
    component: `
import { Stack } from "beamery-design-system-hybrid-beta"
<Stack direction="column" gapBetweenChildren="x4">
  <div>Child 1</div>
  <div>Child 2</div>
</Stack>`,
    
    // Tailwind classes for v0/artifacts
    classes: {
      directions: {
        column: "flex flex-col",
        row: "flex flex-row"
      },
      gaps: {
        x0: "gap-0",    // 0px
        x1: "gap-1",    // 4px
        x2: "gap-2",    // 8px
        x3: "gap-3",    // 12px
        x4: "gap-4",    // 16px - most common
        x6: "gap-6",    // 24px
        x10: "gap-10",  // 40px
        x18: "gap-18"   // 72px
      }
    },
    
    examples: {
      form: `<div className="flex flex-col gap-6">
  <div className="flex flex-col gap-4">
    <input className="..." />
    <input className="..." />
  </div>
  <button className="...">Submit</button>
</div>`,
      
      horizontal: `<div className="flex flex-row gap-4">
  <button>Cancel</button>
  <button>Save</button>
</div>`
    }
  },

  Card: {
    // v0/Claude Desktop compatible
    usage: `
<div className="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
  Content here
</div>`,
    
    // Actual component
    component: `
import { Card } from "beamery-design-system-hybrid-beta"
<Card padding="x6">Content here</Card>`,
    
    classes: {
      base: "bg-white rounded-lg border border-gray-200 shadow-sm",
      padding: {
        x4: "p-4",    // 16px
        x6: "p-6"     // 24px - default
      }
    },
    
    examples: {
      form: `<div className="bg-white rounded-lg border border-gray-200 shadow-sm p-6 max-w-md mx-auto">
  <h2 className="text-xl font-semibold mb-6">Create Account</h2>
  <!-- form content -->
</div>`,
      
      dashboard: `<div className="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
  <h3 className="font-medium mb-2">Metric Title</h3>
  <p className="text-2xl font-bold">1,234</p>
</div>`
    }
  },

  Button: {
    // v0/Claude Desktop compatible
    usage: `
<button className="bg-[#492FF4] hover:bg-[#391EE6] text-white px-6 py-3 rounded-md font-medium transition-colors">
  Primary Action
</button>`,
    
    // Actual component
    component: `
import { Button } from "beamery-design-system-hybrid-beta"
<Button variant="primary" startIcon="Add">Primary Action</Button>`,
    
    // All Beamery button variants for v0/artifacts
    variants: {
      primary: "bg-[#492FF4] hover:bg-[#391EE6] active:bg-[#2222C3] text-white shadow-[0_2px_4px_rgba(73,47,244,0.31)]",
      secondary: "bg-[#F1F1F3] hover:bg-[#DBDBE0] active:bg-[#BCBCC3] text-[#1F1F23]",
      subtle: "bg-transparent hover:bg-[#DBDBE0] active:bg-[#BCBCC3] text-[#1F1F23]",
      activation: "bg-[#06742B] hover:bg-[#095D25] active:bg-[#064C1D] text-white shadow-[0_2px_4px_rgba(6,116,43,0.31)]",
      primaryDestructive: "bg-[#BF0338] hover:bg-[#9E002D] active:bg-[#860329] text-white shadow-[0_2px_4px_rgba(191,3,56,0.31)]",
      secondaryDestructive: "bg-[#FFE6E9] hover:bg-[#FFE6E9] text-[#BF0338]",
      subtleDestructive: "bg-transparent hover:bg-[#BF0338] hover:text-white text-[#BF0338]"
    },
    
    // Base classes - CORRECT Beamery sizing
    base: "inline-flex items-center justify-center h-10 px-4 py-2 rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed",
    
    // Size modifiers
    sizes: {
      small: "h-9 px-3 text-sm",      // Smaller Beamery button
      default: "h-10 px-4 py-2 text-sm",  // Standard Beamery button  
      large: "h-11 px-8 text-sm"      // Larger Beamery button
    },
    
    examples: {
      primary: `<button className="inline-flex items-center justify-center h-10 px-4 py-2 rounded-md text-sm font-medium transition-colors bg-[#492FF4] hover:bg-[#391EE6] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#492FF4]">
  Create Account
</button>`,
      
      withIcon: `<button className="inline-flex items-center justify-center gap-2 h-10 px-4 py-2 rounded-md text-sm font-medium transition-colors bg-[#492FF4] hover:bg-[#391EE6] text-white">
  <svg className="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 2L3 7v11h4v-6h6v6h4V7l-7-5z"/>
  </svg>
  Save Changes
</button>`,
      
      destructive: `<button className="inline-flex items-center justify-center h-10 px-4 py-2 rounded-md text-sm font-medium transition-colors bg-[#BF0338] hover:bg-[#9E002D] text-white">
  Delete Item
</button>`
    }
  },

  Input: {
    // v0/Claude Desktop compatible
    usage: `
<div className="space-y-2">
  <label className="block text-sm font-medium text-[#1F1F23]">Email</label>
  <input 
    type="email" 
    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
    placeholder="Enter your email"
  />
</div>`,
    
    // Actual component
    component: `
import { Input } from "beamery-design-system-hybrid-beta"
<Input label="Email" type="email" placeholder="Enter your email" />`,
    
    classes: {
      wrapper: "space-y-2",
      label: "block text-sm font-medium text-[#1F1F23]",
      input: "w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors placeholder:text-gray-500",
      error: "w-full px-3 py-2 border border-red-500 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors",
      errorText: "text-sm text-red-600 mt-1",
      description: "text-sm text-gray-600 mt-1"
    },
    
    examples: {
      basic: `<div className="space-y-2">
  <label className="block text-sm font-medium text-[#1F1F23]">Full Name</label>
  <input 
    type="text" 
    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
    placeholder="Enter your name"
  />
</div>`,
      
      withError: `<div className="space-y-2">
  <label className="block text-sm font-medium text-[#1F1F23]">Email</label>
  <input 
    type="email" 
    className="w-full px-3 py-2 border border-red-500 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
    placeholder="Enter your email"
  />
  <p className="text-sm text-red-600">Please enter a valid email address</p>
</div>`,
      
      password: `<div className="space-y-2">
  <label className="block text-sm font-medium text-[#1F1F23]">Password</label>
  <div className="relative">
    <input 
      type="password" 
      className="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
      placeholder="Enter password"
    />
    <button className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
      <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      </svg>
    </button>
  </div>
</div>`
    }
  },

  Typography: {
    // v0/Claude Desktop compatible
    headings: {
      h1: "text-2xl font-bold text-[#1F1F23]",      // 24px
      h2: "text-xl font-bold text-[#1F1F23]",       // 20px
      h3: "text-xl font-bold text-[#1F1F23]",       // 20px
      h4: "text-sm font-bold text-[#1F1F23]",       // 14px
      h5: "text-xs font-bold text-[#1F1F23] uppercase tracking-wide", // 12px
      h6: "text-xs font-bold text-[#1F1F23]"        // 12px
    },
    
    paragraphs: {
      default: "text-sm text-[#1F1F23] leading-relaxed",     // 14px
      emphasised: "text-sm text-[#1F1F23] font-medium leading-relaxed",
      compact: "text-sm text-[#1F1F23] leading-tight",
      small: "text-xs text-[#1F1F23] leading-relaxed",       // 12px
      secondary: "text-sm text-[#6C6C7A] leading-relaxed"    // Secondary color
    },
    
    text: {
      control: "text-sm text-[#1F1F23]",
      input: "text-sm text-[#1F1F23]",
      label: "text-sm font-medium text-[#1F1F23]",
      link: "text-sm text-[#492FF4] hover:text-[#391EE6] cursor-pointer"
    },
    
    examples: {
      pageTitle: `<h1 className="text-2xl font-bold text-[#1F1F23] mb-6">Dashboard</h1>`,
      sectionTitle: `<h2 className="text-xl font-bold text-[#1F1F23] mb-4">User Settings</h2>`,
      formLabel: `<label className="text-sm font-medium text-[#1F1F23]">Email Address</label>`,
      bodyText: `<p className="text-sm text-[#1F1F23] leading-relaxed">Welcome to your dashboard where you can manage all your account settings.</p>`,
      secondaryText: `<p className="text-sm text-[#6C6C7A] leading-relaxed">This information helps us provide better service.</p>`,
      link: `<a href="#" className="text-sm text-[#492FF4] hover:text-[#391EE6] cursor-pointer">Learn more</a>`
    }
  },

  // Common Patterns
  patterns: {
    loginForm: `<div className="min-h-screen flex items-center justify-center bg-gray-50 p-4">
  <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-6 w-full max-w-md">
    <div className="text-center mb-6">
      <h1 className="text-2xl font-bold text-[#1F1F23] mb-2">Welcome Back</h1>
      <p className="text-sm text-[#6C6C7A]">Sign in to your account</p>
    </div>
    
    <div className="flex flex-col gap-4">
      <div className="space-y-2">
        <label className="block text-sm font-medium text-[#1F1F23]">Email</label>
        <input 
          type="email" 
          className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
          placeholder="Enter your email"
        />
      </div>
      
      <div className="space-y-2">
        <label className="block text-sm font-medium text-[#1F1F23]">Password</label>
        <input 
          type="password" 
          className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
          placeholder="Enter your password"
        />
      </div>
      
      <button className="w-full inline-flex items-center justify-center h-10 px-4 py-2 rounded-md text-sm font-medium transition-colors bg-[#492FF4] hover:bg-[#391EE6] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#492FF4]">
        Sign In
      </button>
    </div>
  </div>
</div>`,
    
    registrationForm: `<div className="min-h-screen flex items-center justify-center bg-gray-50 p-4">
  <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-6 w-full max-w-md">
    <div className="text-center mb-6">
      <h1 className="text-2xl font-bold text-[#1F1F23] mb-2">Create Account</h1>
      <p className="text-sm text-[#6C6C7A]">Join Beamery today</p>
    </div>
    
    <div className="flex flex-col gap-4">
      <div className="flex flex-row gap-3">
        <div className="space-y-2 flex-1">
          <label className="block text-sm font-medium text-[#1F1F23]">First Name</label>
          <input 
            type="text" 
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
            placeholder="First name"
          />
        </div>
        <div className="space-y-2 flex-1">
          <label className="block text-sm font-medium text-[#1F1F23]">Last Name</label>
          <input 
            type="text" 
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
            placeholder="Last name"
          />
        </div>
      </div>
      
      <div className="space-y-2">
        <label className="block text-sm font-medium text-[#1F1F23]">Email</label>
        <input 
          type="email" 
          className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
          placeholder="Enter your email"
        />
      </div>
      
      <div className="space-y-2">
        <label className="block text-sm font-medium text-[#1F1F23]">Password</label>
        <input 
          type="password" 
          className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
          placeholder="Create a password"
        />
        <p className="text-sm text-[#6C6C7A]">Must be at least 8 characters</p>
      </div>
      
      <button className="w-full inline-flex items-center justify-center h-10 px-4 py-2 rounded-md text-sm font-medium transition-colors bg-[#492FF4] hover:bg-[#391EE6] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#492FF4]">
        Create Account
      </button>
    </div>
  </div>
</div>`,
    
    dashboard: `<div className="min-h-screen bg-gray-50">
  <div className="max-w-6xl mx-auto p-6">
    <h1 className="text-2xl font-bold text-[#1F1F23] mb-6">Dashboard</h1>
    
    <div className="flex flex-col gap-6">
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
          <h3 className="text-sm font-bold text-[#1F1F23] mb-2">Total Users</h3>
          <p className="text-2xl font-bold text-[#1F1F23]">1,234</p>
          <p className="text-sm text-[#6C6C7A]">+12% from last month</p>
        </div>
        
        <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
          <h3 className="text-sm font-bold text-[#1F1F23] mb-2">Active Sessions</h3>
          <p className="text-2xl font-bold text-[#1F1F23]">891</p>
          <p className="text-sm text-[#6C6C7A]">+5% from last month</p>
        </div>
        
        <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
          <h3 className="text-sm font-bold text-[#1F1F23] mb-2">Revenue</h3>
          <p className="text-2xl font-bold text-[#1F1F23]">$45,678</p>
          <p className="text-sm text-[#6C6C7A]">+8% from last month</p>
        </div>
      </div>
    </div>
  </div>
</div>`
  }
}

// Quick access functions for v0/Claude Desktop
export const getBeameryButton = (variant = 'primary') => {
  const base = BEAMERY_HYBRID_COMPONENTS.Button.base
  const variantClass = BEAMERY_HYBRID_COMPONENTS.Button.variants[variant]
  return `${base} ${variantClass}`
}

export const getBeameryInput = (hasError = false) => {
  return hasError 
    ? BEAMERY_HYBRID_COMPONENTS.Input.classes.error
    : BEAMERY_HYBRID_COMPONENTS.Input.classes.input
}

export const getBeameryCard = (padding = 'x6') => {
  const base = BEAMERY_HYBRID_COMPONENTS.Card.classes.base
  const paddingClass = BEAMERY_HYBRID_COMPONENTS.Card.classes.padding[padding]
  return `${base} ${paddingClass}`
}