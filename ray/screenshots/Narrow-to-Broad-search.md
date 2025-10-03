# Narrow to Broad search

We have defined three different searches which match a recruiters workflow when sourcing candidates for a role: Exact, Close and Broad:

| Search | Description | Required role title (Filter, Multiple OR) | Required skills (Filter, Multiple AND) | Required company (Filter, Multiple OR) | Locations (Filer, Multiple OR) | Role (for Rating) | Skills (for Rating) | Location(s) (for Rating) | Industry (for Rating) | Company Size (for Rating) |
|-------------|-------------|------------------------------------------|----------------------------------------|---------------------------------------|-------------------------------|-------------------|-------------------|-------------------------|---------------------|-------------------------|
| Exact | Same job role with title variations | Role Bucket 1 | Must-Have | Company Bucket 1 +2 | Extracted from Prompt - or followup request | Cannonical conversion | All | N/A | Taken from Company | Taken from Company |
| Close | Close Job role variations | Role Bucket 2 | Must-Have | Company Bucket 1 +2 | Extracted from Prompt - or followup request | Cannonical conversion | All | N/A | Taken from Company | Taken from Company |
| Broad | All related roles, skill compositions | N/A | Must-Have | N/A | Extracted from Prompt - or followup request | Cannonical conversion | All | N/A | Taken from Company | Taken from Company |

As part of building the Narrow to Broad there are multiple inputs to achieve the range of searches

- Job titles
- Skills
- Companies

## Job title buckets

I want you to create **2 buckets of job titles** that candidates might use on their CVs for a given role. Role titles need to be unique and not re-used across buckets. The buckets should progressively widen the scope:

### Bucket 1 → True Job Title Synonyms

- Same job role with title variations
- Direct synonyms or very close equivalents of the given role title. Must contain the same key discipline/field in the title (e.g., "Optical Engineer," "Optical Design Engineer" for Optical Engineer).

### Bucket 2 → Job role variations (Same Industry / Sector)

- Job role variations
- Roles with overlapping scope and responsibilities within the **same industry/sector**. These titles should be directly relevant but may use different terminology (e.g., "Opto-Mechanical Engineer" or "Lithography Engineer" at ASML for Optical Engineer).

For each bucket:

1. Provide a bulleted list of example titles.
2. Keep **Bucket 1 as tight as possible** (only direct synonyms).

Here's the input format:

**Role:** [Insert job title]
**Company:** [Insert company]
**Location:** [Insert location]
**Industry:** [Insert Industry]
**Company size:** [Insert Company Size]

## Skills buckets

**⭐ Must-Have (Primary):**
Skills that are fundamental to performing the role. These are the ones you would expect to see declared on almost every strong candidate's profile.

Please:

- Focus only on **declare-able skills** (things candidates would list on a CV/LinkedIn).
- Remove noise skills
- Prioritize clarity and conciseness.
- Keep the final output in the three-tier structure above.

Example output format (for Associate Data Science Engineer):

**⭐ Must-Have**

- Python
- Data Science
- Machine Learning
- Statistical Modeling
- Data Analysis

**✅ Strongly Preferred**

- Classification Predictive Modeling
- Predictive Analytics
- Predictive Model Deployment

**🎉 Nice-to-Have**

- Forecasting Models
- Optimization Modeling
- Product Development
- Product Optimization

## Company Buckets

I want you to create **2 buckets of target companies** where potential candidates for a given role may currently work. The buckets should progressively widen the scope:

### Bucket 1 → Tightest: Direct Competitors / Same Niche

Companies that are the closest match to the given company. These are direct competitors or peers, producing similar products or services, and likely employ candidates in nearly identical roles.

### Bucket 2 → Adjacent Companies (Same Industry / Sector)

Companies in the same industry, sector that are not direct competitors but operate in the same ecosystem (supply chain partners, equipment manufacturers, related technologies). Employees here often have transferable domain expertise.

For each bucket:

1. Provide a bulleted list of example companies.
2. Keep **Bucket 1 as tight as possible** (direct competitors only).
3. Ensure Buckets 2 expands scope logically.

Here's the input format:

**Role:** [Insert job title]
**Company:** [Insert company]
**Location:** [Insert location]
