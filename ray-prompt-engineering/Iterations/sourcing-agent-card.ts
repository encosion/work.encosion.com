import type { AgentCard } from '@a2a-js/sdk';

export const createSourcingAgentCard = (
  sourcingAgentUrl: string,
): AgentCard => {
  return {
    protocolVersion: '0.3.0',
    name: 'Sourcing Agent',
    description: `The Sourcing Agent sources prospects for any job role and location using the Beamery CRM. It generates strategic searches using structured criteria: any (OR) match of job role/title variations, any (OR) match of locations (with variable radius), any (OR) match of ideal companies, and all (AND) match of core skills. Use this agent to source candidates, refine search criteria (roles, skills, locations, companies), or start new prospect searches.`,

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
        description: `Handles initial sourcing requests for prospects.
Supports finding talent by job role, location, skills, and company experience.`,
        tags: [
          'sourcing',
          'prospect-search',
          'talent-search',
          'candidate-search',
          'contact-search',
          'role-search',
          'skill-search',
          'location-search',
          'company-search',
        ],
        examples: [
          'Find software engineers in San Francisco',
          'I need a Senior Product Manager with SQL skills in London',
          'Source Python developers who worked at Google or Meta',
          'Find data scientists in Berlin with machine learning experience',
          'Hire DevOps engineers in Austin with Kubernetes skills from Amazon, Microsoft or Netflix',
          'Need frontend engineers in New York or remote, must have React and TypeScript',
        ],
        inputModes: ['text/plain'],
        outputModes: ['text/plain', 'application/json'],
      },
      {
        id: 'refinement',
        name: 'Search Criteria Updates',
        description: `Supports iterative refinement of search criteria.
Add or remove job roles, core skills, locations (with radius), or ideal companies.`,
        tags: [
          'add-role',
          'remove-role',
          'add-skill',
          'remove-skill',
          'add-location',
          'remove-location',
          'add-company',
          'remove-company',
        ],
        examples: [
          'Update skills to include Java',
          'Add machine learning skill',
          'Remove machine learning requirements',
          'Add Python and MongoDB, remove React',
          'Remove React from the skills list',
          'Change location to London and add 50 miles radius',
          'Remove Google and add Amazon and Meta to ideal companies',
          'Don\'t include ASML, want to hire externally not internally',
          'Remove React and add Python to skills. Remove Google and add Amazon and Meta to ideal companies. Make Berlin location radius 50 miles',
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