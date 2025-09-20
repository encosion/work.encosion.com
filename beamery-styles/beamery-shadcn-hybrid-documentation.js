// Beamery-Shadcn Hybrid Documentation for v0/Claude Desktop
// Complete usage guide for artifact compatibility

export const BEAMERY_HYBRID_DOCUMENTATION = {
  // Quick Start Guide for v0/Claude Desktop
  quickStart: {
    description: "Using Beamery Design System components in v0/Claude Desktop artifacts",
    
    // No imports needed - just copy these patterns
    basicSetup: `
<!-- No imports required for v0/Claude Desktop -->
<!-- Just use these Tailwind classes directly -->

<div className="min-h-screen bg-gray-50 flex items-center justify-center p-4">
  <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-6 w-full max-w-md">
    <h1 className="text-2xl font-bold text-[#1F1F23] mb-4">Beamery Component</h1>
    <button className="inline-flex items-center justify-center px-6 py-3 rounded-md font-medium transition-colors bg-[#492FF4] hover:bg-[#391EE6] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#492FF4] w-full">
      Get Started
    </button>
  </div>
</div>
    `,
    
    // For local development with actual components
    localDevelopment: `
import { Button, Card, Stack, Input, Heading } from "beamery-design-system-hybrid-beta"

<Card padding="x6">
  <Stack direction="column" gapBetweenChildren="x4">
    <Heading variant="2">Welcome</Heading>
    <Button variant="primary" fullWidth>Get Started</Button>
  </Stack>
</Card>
    `
  },

  // Design System Principles for v0/Claude Desktop
  principles: {
    accessibility: {
      guidelines: [
        "Always use proper semantic HTML elements",
        "Include proper labels for form inputs", 
        "Ensure 4.5:1 contrast ratio for text (AA rating)",
        "Make interactive elements keyboard accessible",
        "Use aria-labels for icon-only buttons"
      ],
      
      examples: {
        accessibleButton: `<button 
  className="inline-flex items-center justify-center px-6 py-3 rounded-md font-medium transition-colors bg-[#492FF4] hover:bg-[#391EE6] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#492FF4]"
  aria-label="Create new account"
>
  Sign Up
</button>`,
        
        accessibleForm: `<div className="space-y-2">
  <label htmlFor="email" className="block text-sm font-medium text-[#1F1F23]">
    Email Address
  </label>
  <input 
    id="email"
    type="email" 
    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
    placeholder="Enter your email"
    required
    aria-describedby="email-help"
  />
  <p id="email-help" className="text-sm text-[#6C6C7A]">
    We'll never share your email
  </p>
</div>`
      }
    },
    
    colorUsage: {
      rules: [
        "Use #492FF4 (Beamery Purple) for primary actions and brand elements",
        "Use #1F1F23 for primary text on light backgrounds",
        "Use #6C6C7A for secondary text and descriptions",
        "Use semantic colors: #06742B for success, #BF0338 for errors",
        "Maintain proper contrast ratios for accessibility"
      ],
      
      examples: {
        primaryText: `<h1 className="text-[#1F1F23]">Primary heading text</h1>`,
        secondaryText: `<p className="text-[#6C6C7A]">Secondary description text</p>`,
        brandColor: `<button className="bg-[#492FF4] text-white">Brand button</button>`,
        successColor: `<div className="bg-green-50 border border-green-200 text-[#06742B] p-3 rounded">Success message</div>`,
        errorColor: `<div className="bg-red-50 border border-red-200 text-[#BF0338] p-3 rounded">Error message</div>`
      }
    },
    
    spacing: {
      description: "Beamery uses a 4px grid system for consistent spacing",
      scale: {
        x1: "4px - gap-1",
        x2: "8px - gap-2", 
        x3: "12px - gap-3",
        x4: "16px - gap-4 (most common)",
        x6: "24px - gap-6",
        x10: "40px - gap-10"
      },
      
      examples: {
        verticalSpacing: `<div className="flex flex-col gap-4">
  <div>Item 1</div>
  <div>Item 2</div>
  <div>Item 3</div>
</div>`,
        
        formSpacing: `<div className="flex flex-col gap-6">
  <div className="flex flex-col gap-4">
    <!-- Form fields with gap-4 -->
  </div>
  <button>Submit</button> <!-- Larger gap-6 before action -->
</div>`
      }
    }
  },

  // Component Usage Patterns
  patterns: {
    // Authentication Forms
    authForms: {
      description: "Common patterns for login, registration, and password reset forms",
      
      loginForm: {
        description: "Standard login form with email and password",
        code: `<div className="min-h-screen flex items-center justify-center bg-gray-50 p-4">
  <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-6 w-full max-w-md">
    <div className="text-center mb-6">
      <h1 className="text-2xl font-bold text-[#1F1F23] mb-2">Welcome Back</h1>
      <p className="text-sm text-[#6C6C7A]">Sign in to your account</p>
    </div>
    
    <form className="flex flex-col gap-4">
      <div className="space-y-2">
        <label htmlFor="email" className="block text-sm font-medium text-[#1F1F23]">
          Email
        </label>
        <input 
          id="email"
          type="email" 
          className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
          placeholder="Enter your email"
          required
        />
      </div>
      
      <div className="space-y-2">
        <label htmlFor="password" className="block text-sm font-medium text-[#1F1F23]">
          Password
        </label>
        <input 
          id="password"
          type="password" 
          className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
          placeholder="Enter your password"
          required
        />
      </div>
      
      <button 
        type="submit"
        className="w-full inline-flex items-center justify-center px-6 py-3 rounded-md font-medium transition-colors bg-[#492FF4] hover:bg-[#391EE6] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#492FF4]"
      >
        Sign In
      </button>
    </form>
    
    <div className="mt-4 text-center">
      <a href="#" className="text-sm text-[#492FF4] hover:text-[#391EE6]">
        Forgot your password?
      </a>
    </div>
  </div>
</div>`
      },
      
      registrationForm: {
        description: "User registration form with validation",
        code: `<div className="min-h-screen flex items-center justify-center bg-gray-50 p-4">
  <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-6 w-full max-w-md">
    <div className="text-center mb-6">
      <h1 className="text-2xl font-bold text-[#1F1F23] mb-2">Create Account</h1>
      <p className="text-sm text-[#6C6C7A]">Join Beamery today</p>
    </div>
    
    <form className="flex flex-col gap-4">
      <div className="flex flex-row gap-3">
        <div className="space-y-2 flex-1">
          <label htmlFor="firstName" className="block text-sm font-medium text-[#1F1F23]">
            First Name
          </label>
          <input 
            id="firstName"
            type="text" 
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
            placeholder="First name"
            required
          />
        </div>
        <div className="space-y-2 flex-1">
          <label htmlFor="lastName" className="block text-sm font-medium text-[#1F1F23]">
            Last Name
          </label>
          <input 
            id="lastName"
            type="text" 
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
            placeholder="Last name"
            required
          />
        </div>
      </div>
      
      <div className="space-y-2">
        <label htmlFor="email" className="block text-sm font-medium text-[#1F1F23]">
          Email
        </label>
        <input 
          id="email"
          type="email" 
          className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
          placeholder="Enter your email"
          required
        />
      </div>
      
      <div className="space-y-2">
        <label htmlFor="password" className="block text-sm font-medium text-[#1F1F23]">
          Password
        </label>
        <input 
          id="password"
          type="password" 
          className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
          placeholder="Create a password"
          required
        />
        <p className="text-sm text-[#6C6C7A]">Must be at least 8 characters</p>
      </div>
      
      <button 
        type="submit"
        className="w-full inline-flex items-center justify-center px-6 py-3 rounded-md font-medium transition-colors bg-[#492FF4] hover:bg-[#391EE6] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#492FF4]"
      >
        Create Account
      </button>
    </form>
  </div>
</div>`
      }
    },
    
    // Dashboard Layouts
    dashboards: {
      description: "Common dashboard and data display patterns",
      
      metricCards: {
        description: "Grid of metric cards for dashboard overview",
        code: `<div className="min-h-screen bg-gray-50">
  <div className="max-w-6xl mx-auto p-6">
    <h1 className="text-2xl font-bold text-[#1F1F23] mb-6">Dashboard</h1>
    
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
      <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
        <h3 className="text-sm font-bold text-[#1F1F23] mb-2">Total Users</h3>
        <p className="text-2xl font-bold text-[#1F1F23] mb-1">1,234</p>
        <p className="text-sm text-[#06742B]">+12% from last month</p>
      </div>
      
      <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
        <h3 className="text-sm font-bold text-[#1F1F23] mb-2">Active Sessions</h3>
        <p className="text-2xl font-bold text-[#1F1F23] mb-1">891</p>
        <p className="text-sm text-[#06742B]">+5% from last month</p>
      </div>
      
      <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
        <h3 className="text-sm font-bold text-[#1F1F23] mb-2">Revenue</h3>
        <p className="text-2xl font-bold text-[#1F1F23] mb-1">$45,678</p>
        <p className="text-sm text-[#BF0338]">-2% from last month</p>
      </div>
    </div>
  </div>
</div>`
      }
    },
    
    // Form Layouts
    forms: {
      description: "Various form layout patterns and validation states",
      
      settingsForm: {
        description: "Settings form with sections and actions",
        code: `<div className="max-w-2xl mx-auto p-6">
  <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
    <h2 className="text-xl font-bold text-[#1F1F23] mb-6">Account Settings</h2>
    
    <form className="flex flex-col gap-6">
      <div className="flex flex-col gap-4">
        <h3 className="text-sm font-bold text-[#1F1F23] uppercase tracking-wide">
          Personal Information
        </h3>
        
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div className="space-y-2">
            <label htmlFor="firstName" className="block text-sm font-medium text-[#1F1F23]">
              First Name
            </label>
            <input 
              id="firstName"
              type="text" 
              className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
              defaultValue="John"
            />
          </div>
          
          <div className="space-y-2">
            <label htmlFor="lastName" className="block text-sm font-medium text-[#1F1F23]">
              Last Name
            </label>
            <input 
              id="lastName"
              type="text" 
              className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
              defaultValue="Doe"
            />
          </div>
        </div>
        
        <div className="space-y-2">
          <label htmlFor="email" className="block text-sm font-medium text-[#1F1F23]">
            Email
          </label>
          <input 
            id="email"
            type="email" 
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#492FF4] focus:border-[#492FF4] transition-colors"
            defaultValue="john@example.com"
          />
        </div>
      </div>
      
      <div className="flex flex-row gap-3 justify-end">
        <button 
          type="button"
          className="inline-flex items-center justify-center px-6 py-3 rounded-md font-medium transition-colors bg-transparent hover:bg-[#DBDBE0] text-[#1F1F23] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#DBDBE0]"
        >
          Cancel
        </button>
        <button 
          type="submit"
          className="inline-flex items-center justify-center px-6 py-3 rounded-md font-medium transition-colors bg-[#492FF4] hover:bg-[#391EE6] text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#492FF4]"
        >
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>`
      }
    }
  },

  // Error Handling and Validation
  validation: {
    description: "How to handle errors and validation states in forms",
    
    patterns: {
      fieldError: {
        description: "Individual field with error state",
        code: `<div className="space-y-2">
  <label htmlFor="email" className="block text-sm font-medium text-[#1F1F23]">
    Email <span className="text-[#BF0338]">*</span>
  </label>
  <input 
    id="email"
    type="email" 
    className="w-full px-3 py-2 border border-red-500 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
    placeholder="Enter your email"
    aria-invalid="true"
    aria-describedby="email-error"
  />
  <p id="email-error" className="text-sm text-[#BF0338]">
    Please enter a valid email address
  </p>
</div>`
      },
      
      successState: {
        description: "Form field with success validation",
        code: `<div className="space-y-2">
  <label htmlFor="password" className="block text-sm font-medium text-[#1F1F23]">
    Password
  </label>
  <input 
    id="password"
    type="password" 
    className="w-full px-3 py-2 border border-green-500 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
    placeholder="Enter your password"
  />
  <p className="text-sm text-[#06742B]">
    Strong password - well done!
  </p>
</div>`
      },
      
      formAlert: {
        description: "Form-level error or success message",
        code: `<!-- Error Alert -->
<div className="bg-red-50 border border-red-200 rounded-md p-4 mb-4">
  <div className="flex">
    <div className="flex-shrink-0">
      <svg className="h-5 w-5 text-[#BF0338]" viewBox="0 0 20 20" fill="currentColor">
        <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clipRule="evenodd" />
      </svg>
    </div>
    <div className="ml-3">
      <h3 className="text-sm font-medium text-[#BF0338]">
        There were errors with your submission
      </h3>
      <div className="mt-2 text-sm text-[#BF0338]">
        <ul className="list-disc pl-5 space-y-1">
          <li>Email address is required</li>
          <li>Password must be at least 8 characters</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Success Alert -->
<div className="bg-green-50 border border-green-200 rounded-md p-4 mb-4">
  <div className="flex">
    <div className="flex-shrink-0">
      <svg className="h-5 w-5 text-[#06742B]" viewBox="0 0 20 20" fill="currentColor">
        <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
      </svg>
    </div>
    <div className="ml-3">
      <p className="text-sm font-medium text-[#06742B]">
        Account created successfully! Welcome to Beamery.
      </p>
    </div>
  </div>
</div>`
      }
    }
  },

  // Best Practices
  bestPractices: {
    description: "Guidelines for creating effective Beamery-styled components",
    
    guidelines: [
      "Always use semantic HTML elements (button, input, label, etc.)",
      "Include proper labels and ARIA attributes for accessibility", 
      "Use Beamery's exact color values (#492FF4, #1F1F23, #6C6C7A, etc.)",
      "Follow the 4px spacing grid system (gap-1, gap-2, gap-4, gap-6)",
      "Apply focus states to all interactive elements",
      "Use transitions for smooth hover and focus effects",
      "Ensure proper contrast ratios for text readability",
      "Make forms keyboard navigable",
      "Provide clear error messages and validation feedback"
    ],
    
    commonMistakes: [  
      "Using generic colors instead of Beamery brand colors",
      "Inconsistent spacing that doesn't follow the 4px grid",
      "Missing focus states on interactive elements",
      "Poor form labeling and accessibility",
      "Incorrect button hierarchy (too many primary buttons)",
      "Inadequate error handling and validation feedback"
    ],
    
    performance: [
      "Use Tailwind's utility classes for optimal CSS bundling",
      "Minimize custom CSS by leveraging Tailwind utilities",
      "Prefer native HTML elements over complex div structures",
      "Use proper semantic markup for better SEO and accessibility"
    ]
  },

  // Responsive Design
  responsive: {
    description: "Creating responsive layouts with Beamery components",
    
    breakpoints: {
      sm: "640px",
      md: "768px", 
      lg: "1024px",
      xl: "1280px"
    },
    
    patterns: {
      responsiveCards: `<div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
  <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
    <h3 className="text-sm font-bold text-[#1F1F23]">Card 1</h3>
  </div>
  <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
    <h3 className="text-sm font-bold text-[#1F1F23]">Card 2</h3>
  </div>
  <div className="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
    <h3 className="text-sm font-bold text-[#1F1F23]">Card 3</h3>
  </div>
</div>`,
      
      responsiveForm: `<div className="w-full max-w-md mx-auto p-4 sm:p-6">
  <form className="flex flex-col gap-4">
    <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div className="space-y-2">
        <label className="block text-sm font-medium text-[#1F1F23]">First Name</label>
        <input className="w-full px-3 py-2 border border-gray-300 rounded-md" />
      </div>
      <div className="space-y-2">
        <label className="block text-sm font-medium text-[#1F1F23]">Last Name</label>
        <input className="w-full px-3 py-2 border border-gray-300 rounded-md" />
      </div>
    </div>
    
    <div className="flex flex-col sm:flex-row gap-3">
      <button className="flex-1 bg-[#F1F1F3] hover:bg-[#DBDBE0] text-[#1F1F23] px-6 py-3 rounded-md">
        Cancel
      </button>
      <button className="flex-1 bg-[#492FF4] hover:bg-[#391EE6] text-white px-6 py-3 rounded-md">
        Submit
      </button>
    </div>
  </form>
</div>`
    }
  }
}

// Quick reference functions
export const getPattern = (patternType, patternName) => {
  return BEAMERY_HYBRID_DOCUMENTATION.patterns[patternType]?.[patternName]?.code || ''
}

export const getValidationExample = (type) => {
  return BEAMERY_HYBRID_DOCUMENTATION.validation.patterns[type]?.code || ''
}

export const getBestPractices = () => {
  return BEAMERY_HYBRID_DOCUMENTATION.bestPractices.guidelines
}