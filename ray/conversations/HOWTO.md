# HOWTO: Creating New Conversations in Ray

This guide provides detailed step-by-step instructions for creating new conversation scenarios in the Ray recruitment sourcing assistant prototype. Each conversation simulates a different recruitment scenario with realistic candidate data and search strategies.

## 📋 Overview

A complete conversation consists of:
- **Configuration file** (`config.json`) - User profile settings
- **Conversation steps** (`.php` files) - Interactive chat messages
- **Search result data** (`.json` files) - Candidate profiles and search criteria
- **Result display files** (`.php` files) - Dynamic result rendering

## 🎯 Step-by-Step Process

### Step 1: Plan Your Conversation Scenario

Before creating files, define your recruitment scenario:

**Example: "Data Scientist" conversation**
- **User Name**: "Sarah" (recruiter)
- **Role**: Senior Data Scientist
- **Location**: San Francisco Bay Area
- **Industry**: Technology/FinTech
- **Target Companies**: Google, Meta, Stripe, Airbnb

**Key Questions to Answer:**
1. What specific role are you recruiting for?
2. What location(s) should candidates be from?
3. What companies are your targets?
4. What skills are must-have vs nice-to-have?
5. What's the recruiter's name for personalization?

### Step 2: Create Conversation Directory

```bash
mkdir conversations/data-scientist
cd conversations/data-scientist
```

### Step 3: Create Configuration File

Create `config.json`:

```json
{
    "user_name": "Sarah"
}
```

### Step 4: Create Conversation Step Files

Each conversation follows a specific flow. Copy the structure from existing conversations and customize:

#### 4.1 Initial Greeting (`01_greeting.php`)

```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'stream',
    'nextAction' => 'wait',
    'suggestedResponse' => 'I\'m looking for Senior Data Scientists in the San Francisco Bay Area',
    'typingDelay' => 10
];
?>
<p>Hi <span class="dynamic-user-name">{{USER_NAME}}</span>,</p>
<p>I'm a sourcing assistant. I want to help you find the best prospects for your roles.</p>
<p>What job role are you currently sourcing for? In which locations?</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

**Key Elements:**
- `render: 'stream'` - Message types out character by character
- `suggestedResponse` - Pre-fills the input field for testing
- `{{USER_NAME}}` - Placeholder replaced with config value

#### 4.2 Role Confirmation (`03a_roles_found.php`)

```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'stream',
    'nextAction' => 'proceed-after-render'
];
?>
<p>I found several roles that match your criteria:</p>
<ul>
<li><strong>Senior Data Scientist</strong> - Machine Learning focus</li>
<li><strong>Lead Data Scientist</strong> - Team leadership experience</li>
<li><strong>Principal Data Scientist</strong> - Advanced research role</li>
</ul>
<p>Which of these roles is the best match?</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

#### 4.3 Role Selection (`03b_roles_found.php`)

```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render'
];
?>
<p>Perfect! I'll help you find Senior Data Scientists in the San Francisco Bay Area.</p>
<p>Let me analyze the requirements and build a comprehensive search strategy.</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

#### 4.4 Final Confirmation (`03c_roles_found.php`)

```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'stream',
    'nextAction' => 'proceed-after-render'
];
?>
<p>Excellent! I'll create a "Narrow to Broad" search strategy to find the best Senior Data Scientists.</p>
<p>This approach will start with exact matches and progressively expand to find more candidates.</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

#### 4.5 Streaming Introduction (`10a_streaming_intro.php`)

```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'stream',
    'nextAction' => 'proceed-after-render',
    'typingDelay' => 8
];
?>
<p>Let me search for Senior Data Scientists...</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

#### 4.6 Thinking Steps (`10b_thinking_steps.php`)

```php
<?php
header('Content-Type: text/html; charset=utf-8');

$thinkingSteps = [
    'Extracting core skills',
    'Mapping target locations', 
    'Identifying ideal companies',
    'Finding equivalent job titles',
    'Building search'
];

$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render',
    'thinkingSteps' => $thinkingSteps
];
?>
<div class="thinking-steps" id="thinking-steps">
    <!-- Steps will be dynamically generated by JavaScript -->
</div>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

#### 4.7 Search Strategy Introduction (`10d_search_strategy.php`)

```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'stream',
    'nextAction' => 'proceed-after-render'
];
?>
<p>I've built a comprehensive search strategy with three approaches:</p>
<ul>
<li><strong>🎯 Exact</strong> - Same role with title variations</li>
<li><strong>📏 Close</strong> - Related roles in the same field</li>
<li><strong>🤔 Broad</strong> - Skills-based search across all roles</li>
</ul>
<p>Let me show you each approach:</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

#### 4.8 Search Strategy Details (`13_search_strategy.php`)

```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'stream',
    'nextAction' => 'proceed-after-render'
];
?>
<p>Here's how each search approach works:</p>
<p><strong>🎯 Exact Search:</strong> Targets Senior Data Scientists, Lead Data Scientists, and Principal Data Scientists with Python, Machine Learning, Statistical Analysis, and Data Visualization skills at Google, Meta, Stripe, or Airbnb in the San Francisco Bay Area.</p>
<p><strong>📏 Close Search:</strong> Expands to include Data Engineers, ML Engineers, and Analytics Engineers with the same core skills.</p>
<p><strong>🤔 Broad Search:</strong> Focuses purely on skills - anyone with Python, Machine Learning, Statistical Analysis, and Data Visualization experience.</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

#### 4.9 Search Result Buttons (`12-1_exact.php`, `12-2_close.php`, `12-3_broad.php`)

**Exact Search (`12-1_exact.php`):**
```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render'
];
?>
<h3 style="margin-bottom:8px;margin-top:-1rem;">🎯 Exact</h3>
<ul>
<li><strong>Same job role with title variations:</strong> Senior Data Scientist, Lead Data Scientist, Principal Data Scientist</li>
<li><strong>Core skills:</strong> Python, Machine Learning, Statistical Analysis, Data Visualization</li>
<li><strong>Location:</strong> San Francisco Bay Area (50 miles)</li>
<li><strong>Ideal companies to start sourcing from:</strong> Google, Meta, Stripe, Airbnb.</li>
<button load-="exact.php">Load results 👉</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

**Close Search (`12-2_close.php`):**
```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render'
];
?>
<h3 style="margin-bottom:8px;margin-top:-1rem;">📏 Close</h3>
<ul>
<li><strong>Close job role variations:</strong> Data Engineer, ML Engineer, Analytics Engineer, Research Scientist</li>
<li><strong>Core skills:</strong> Python, Machine Learning, Statistical Analysis, Data Visualization</li>
<li><strong>Location:</strong> San Francisco Bay Area (50 miles)</li>
<li><strong>Ideal companies to start sourcing from:</strong> Google, Meta, Stripe, Airbnb.</li>
<button load-="close.php">Load results 👉</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

**Broad Search (`12-3_broad.php`):**
```php
<?php
header('Content-Type: text/html; charset=utf-8');

$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render'
];
?>
<h3 style="margin-bottom:8px;margin-top:-1rem;">🤔 Broad</h3>
<ul>
<li><strong>All related roles, skill compositions:</strong> Any role with required skills</li>
<li><strong>Core skills:</strong> Python, Machine Learning, Statistical Analysis, Data Visualization</li>
<li><strong>Location:</strong> San Francisco Bay Area (50 miles)</li>
<li><strong>Ideal companies:</strong> Any company with relevant roles</li>
<button load-="broad.php">Load results 👉</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
```

### Step 5: Create Search Result Data Files

#### 5.1 Exact Search Results (`exact.json`)

```json
{
  "searchTitle": "🎯 Exact",
  "searchDescription": "Senior Data Scientists at target companies (Google, Meta, Stripe, Airbnb) with Python, Machine Learning, Statistical Analysis, Data Visualization within commutable distance of San Francisco Bay Area, USA",
  "searchCriteria": {
    "jobRoles": [
      "Senior Data Scientist",
      "Lead Data Scientist",
      "Principal Data Scientist"
    ],
    "coreSkills": [
      "Python",
      "Machine Learning",
      "Statistical Analysis",
      "Data Visualization"
    ],
    "locations": [
      "San Francisco Bay Area (50 miles)"
    ],
    "idealCompanies": [
      "Google",
      "Meta",
      "Stripe",
      "Airbnb"
    ]
  },
  "candidates": [
    {
      "id": 1,
      "name": "Alex Chen",
      "rating": "★★★★★ 4.9",
      "hasAttachment": true,
      "jobHistory": [
        {
          "title": "Senior Data Scientist",
          "company": "Google",
          "duration": "3y 2m"
        },
        {
          "title": "Data Scientist",
          "company": "Meta",
          "duration": "2y 8m"
        },
        {
          "title": "ML Engineer",
          "company": "Stripe",
          "duration": "2y 1m"
        }
      ],
      "location": "San Francisco, California, USA"
    },
    {
      "id": 2,
      "name": "Maria Rodriguez",
      "rating": "★★★★★ 4.8",
      "hasAttachment": true,
      "jobHistory": [
        {
          "title": "Lead Data Scientist",
          "company": "Meta",
          "duration": "2y 6m"
        },
        {
          "title": "Senior Data Scientist",
          "company": "Google",
          "duration": "3y 1m"
        },
        {
          "title": "Data Analyst",
          "company": "Airbnb",
          "duration": "2y 3m"
        }
      ],
      "location": "Palo Alto, California, USA"
    }
  ]
}
```

**Candidate Data Structure:**
- `id`: Unique identifier (must be unique across all searches)
- `name`: Candidate's full name
- `rating`: Star rating and numeric score
- `hasAttachment`: Boolean for CV/resume availability
- `jobHistory`: Array of previous roles with title, company, and duration
- `location`: Current location (should match search criteria)

#### 5.2 Close Search Results (`close.json`)

Similar structure but with:
- Different job roles (Data Engineer, ML Engineer, etc.)
- Same core skills
- Same locations and companies
- More candidates (8-15 total)
- Some candidates may have different role titles

#### 5.3 Broad Search Results (`broad.json`)

Similar structure but with:
- Empty `jobRoles` array (skills-based search)
- Empty `idealCompanies` array (any company)
- Same core skills
- Same locations
- Most candidates (15-25 total)
- Diverse role titles and companies

### Step 6: Create Result Display Files

#### 6.1 Exact Results (`exact.php`)

```php
<?php
// results-exact.php
// Dynamic candidate table HTML for recruitment search results

// Load JSON data to get search criteria
$jsonFile = 'exact.json';
$jsonData = json_decode(file_get_contents($jsonFile), true);
$searchCriteria = $jsonData['searchCriteria'] ?? [];

// Include loading spinner
include '../../includes/loading-spinner.php';

// Include filter panel with search criteria
include '../../includes/filters.php';

// Set up page-specific variables
$pageName = 'exact';

// Include the common layout
include '../../includes/results-layout.php';
?>
```

**Key Elements:**
- `$jsonFile` - Points to the corresponding JSON data file
- `$pageName` - Used for JavaScript initialization
- Includes are relative to the conversation directory

#### 6.2 Close Results (`close.php`)

```php
<?php
// results-close.php
// Dynamic candidate table HTML for recruitment search results

// Load JSON data to get search criteria
$jsonFile = 'close.json';
$jsonData = json_decode(file_get_contents($jsonFile), true);
$searchCriteria = $jsonData['searchCriteria'] ?? [];

// Include loading spinner
include '../../includes/loading-spinner.php';

// Include filter panel with search criteria
include '../../includes/filters.php';

// Set up page-specific variables
$pageName = 'close';

// Include the common layout
include '../../includes/results-layout.php';
?>
```

#### 6.3 Broad Results (`broad.php`)

```php
<?php
// results-broad.php
// Dynamic candidate table HTML for recruitment search results

// Load JSON data to get search criteria
$jsonFile = 'broad.json';
$jsonData = json_decode(file_get_contents($jsonFile), true);
$searchCriteria = $jsonData['searchCriteria'] ?? [];

// Include loading spinner
include '../../includes/loading-spinner.php';

// Include filter panel with search criteria
include '../../includes/filters.php';

// Set up page-specific variables
$pageName = 'broad';

// Include the common layout
include '../../includes/results-layout.php';
?>
```

## 🔍 Data Synthesis Guidelines

### Candidate Profile Creation

**Realistic Job Histories:**
- 2-4 previous roles per candidate
- Progressive career advancement
- Mix of durations (1-4 years per role)
- Relevant role titles for the industry

**Location Consistency:**
- All locations should be within the search radius
- Use realistic city names in the target area
- Include state/country for clarity

**Company Targeting:**
- Mix candidates from target companies
- Include some from competitor companies
- Vary the distribution realistically

**Skill Alignment:**
- Job titles should reflect the required skills
- Career progression should make sense
- Include some skill variations (e.g., "Machine Learning" vs "ML")

### Search Criteria Logic

**Exact Search:**
- Tight job title variations only
- All candidates from target companies
- All candidates in target locations
- All candidates have all core skills

**Close Search:**
- Related but different job titles
- Mix of target and competitor companies
- Same locations as exact
- Same core skills

**Broad Search:**
- Diverse job titles across the field
- Any company (including startups, consulting, etc.)
- Same locations
- Same core skills

### Rating Distribution

**Realistic Ratings:**
- Most candidates: 4.3-4.9 stars
- Fewer perfect 5.0 ratings
- Some variation in scores
- Higher ratings for more experienced candidates

## 🧪 Testing Your Conversation

### 1. Access Your Conversation

```
http://your-domain.com/work/ray/?conversation=data-scientist
```

### 2. Test the Flow

1. **Greeting**: Verify user name appears correctly
2. **Role Selection**: Test suggested responses
3. **Search Strategy**: Check all three search types load
4. **Results**: Verify candidate data displays correctly
5. **Filters**: Test filter panel functionality
6. **Selection**: Test candidate selection and bulk actions

### 3. Common Issues

**Missing Candidates:**
- Check JSON file syntax
- Verify all required fields are present
- Ensure unique IDs across all searches

**Filter Issues:**
- Verify `searchCriteria` structure in JSON
- Check that filter pills display correctly
- Test add/remove filter functionality

**Display Problems:**
- Check PHP file includes are correct
- Verify `$pageName` variable is set
- Ensure JSON file paths are correct

## 📝 File Checklist

Before testing, verify you have:

- [ ] `config.json` with user_name
- [ ] `01_greeting.php` with suggested response
- [ ] `03a_roles_found.php` with role options
- [ ] `03b_roles_found.php` with role confirmation
- [ ] `03c_roles_found.php` with final confirmation
- [ ] `10a_streaming_intro.php` with search intro
- [ ] `10b_thinking_steps.php` with thinking steps
- [ ] `10d_search_strategy.php` with strategy intro
- [ ] `12-1_exact.php` with exact search button
- [ ] `12-2_close.php` with close search button
- [ ] `12-3_broad.php` with broad search button
- [ ] `13_search_strategy.php` with strategy details
- [ ] `exact.json` with exact search data
- [ ] `close.json` with close search data
- [ ] `broad.json` with broad search data
- [ ] `exact.php` with exact results display
- [ ] `close.php` with close results display
- [ ] `broad.php` with broad results display

## 🎨 Customization Tips

### Conversation Flow
- Adjust `typingDelay` for different pacing
- Use `appear` for instant messages, `stream` for typing effect
- Customize suggested responses for better testing

### Candidate Data
- Research real companies in your target industry
- Use realistic job titles and career progressions
- Include diverse names and backgrounds

### Search Strategy
- Tailor job title buckets to your specific role
- Adjust skill requirements based on industry standards
- Modify company targeting for your use case

## 🚀 Advanced Features

### Custom Thinking Steps
Modify the thinking steps in `10b_thinking_steps.php`:

```php
$thinkingSteps = [
    'Analyzing role requirements',
    'Identifying skill patterns',
    'Mapping company landscape',
    'Building search queries',
    'Executing searches'
];
```

### Additional Search Types
You can add more search variations by:
1. Creating additional `12-X_*.php` files
2. Adding corresponding JSON data files
3. Creating result display PHP files
4. Updating the search strategy descriptions

### Enhanced Candidate Data
Add more fields to candidate objects:
```json
{
  "id": 1,
  "name": "Alex Chen",
  "rating": "★★★★★ 4.9",
  "hasAttachment": true,
  "experience": "8 years",
  "education": "PhD Computer Science",
  "skills": ["Python", "TensorFlow", "SQL"],
  "jobHistory": [...],
  "location": "San Francisco, California, USA"
}
```

---

This guide provides everything needed to create realistic, engaging conversation scenarios that demonstrate Ray's AI-powered recruitment capabilities. The modular structure allows for easy customization and expansion of the conversation system.
