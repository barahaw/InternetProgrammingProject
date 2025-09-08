# Agent API Documentation

## Overview
The Agent API provides access to user/agent information in the news platform. This includes authors, editors, and administrators.

## Endpoints

### Get All Agents
```
GET /agent_api.php
```
Returns a list of all agents/users in the system.

**Response:**
```json
[
  {
    "id": "1",
    "name": "John Doe",
    "email": "john@example.com",
    "role": "admin"
  },
  {
    "id": "2", 
    "name": "Jane Smith",
    "email": "jane@example.com",
    "role": "author"
  }
]
```

### Get Agents by Role
```
GET /agent_api.php?role=admin
GET /agent_api.php?role=editor
GET /agent_api.php?role=author
```
Returns agents filtered by their role.

### Get Specific Agent
```
GET /agent_api.php?action=get&id=1
```
Returns details for a specific agent by ID.

**Response:**
```json
{
  "id": "1",
  "name": "John Doe", 
  "email": "john@example.com",
  "role": "admin"
}
```

## Error Responses
```json
{
  "error": "Agent not found"
}
```

```json
{
  "error": "Database error: Connection failed"
}
```

## Usage Examples

### JavaScript Fetch
```javascript
// Get all agents
fetch('agent_api.php')
  .then(response => response.json())
  .then(agents => console.log(agents));

// Get authors only  
fetch('agent_api.php?role=author')
  .then(response => response.json())
  .then(authors => console.log(authors));

// Get specific agent
fetch('agent_api.php?action=get&id=1')
  .then(response => response.json())
  .then(agent => console.log(agent));
```

### cURL
```bash
# Get all agents
curl "http://localhost/agent_api.php"

# Get editors only
curl "http://localhost/agent_api.php?role=editor"

# Get specific agent
curl "http://localhost/agent_api.php?action=get&id=1"
```