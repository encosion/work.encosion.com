import type { AgentCard } from '@a2a-js/sdk';

export const createSourcingAgentCard = (
  sourcingAgentUrl: string,
): AgentCard => {
  return {
    protocolVersion: '0.3.0',
    name: 'Sourcing Agent',
    description: `The Sourcing Agent handles all requests related to sourcing contacts and candidates to hire using the Beamery CRM.
It can perform initial sourcing, role-specific searches, and iterative updates to search criteria (skills, location, role, and industry).
Use this agent whenever a request involves finding, refining, or removing candidate requirements.`,

    capabilities: {
      streaming: true,
      pushNotifications: false,
      stateTransitionHistory: false,
      extensions: [],
    },

    defaultInputModes: ['text/plain'],
    defaultOutputModes: ['text/plain', 'application/json'],

    skills: [
      {
        id: 'initial-sourcing',
        name: 'Initial Sourcing',
        description: `Handles broad sourcing requests for candidates or contacts.
Supports finding talent by role, location, skills, and industry.`,
        tags: [
          'sourcing',
          'talent-finding',
          'role-search',
          'location-search',
          'industry-search',
        ],
        examples: [
          'Find software engineers',
          'I need a Senior Product Manager',
          'Source candidates for our engineering team',
          'Recruit talent for senior positions',
          'Hiring a DevOps Engineer in San Francisco',
        ],
        inputModes: ['text/plain'],
        outputModes: ['text/plain', 'application/json'],
      },
      {
        id: 'refinement',
        name: 'Search Criteria Updates',
        description: `Supports iterative refinement of search criteria.
You can add, remove, or update skills, roles, locations, or industries.`,
        tags: [
          'add-skills',
          'remove-skills',
          'update-skills',
          'change-location',
          'remove-location',
          'update-industry',
          'exclude-industry',
          'criteria-refinement',
        ],
        examples: [
          'Update skills to include Java',
          'Add Python to the search',
          'Remove React from the skills list',
          'Change location to London',
          'Exclude remote positions',
          'Modify industry to focus on healthcare',
          'No longer want fintech candidates',
          'Add machine learning skill',
          'Remove machine learning requirements',
        ],
        inputModes: ['text/plain'],
        outputModes: ['text/plain', 'application/json'],
      },
      {
        id: 'structured-role-selection',
        name: 'Structured Role Selection',
        description: `Extracts canonical job roles from conversation and presents structured role selection data for CRM MCP tools.`,
        tags: ['job-architecture', 'role-selection', 'structured-input'],
        examples: [
          '{ resume: { id: "software_engineer", label: "Software Engineer" } }',
          '{ resume: { id: "data_scientist", label: "Data Scientist" } }',
        ],
        inputModes: ['text/plain', 'application/json'],
        outputModes: ['text/plain', 'application/json'],
      },
    ],

    url: sourcingAgentUrl,
    version: '1.0.0',
    provider: {
      organization: 'Beamery',
      url: 'https://beamery.com',
    },

    securitySchemes: {
      http: {
        type: 'http',
        scheme: 'Bearer',
      },
    },

    preferredTransport: 'JSONRPC',
  };
};