#!/bin/bash

# Installation script for Internet Programming Project
echo "🚀 Setting up Internet Programming Project..."

# Check if config.php exists
if [ ! -f "config.php" ]; then
    echo "📝 Creating config.php from template..."
    cp config.php.template config.php
    echo "✅ config.php created. Please update it with your database credentials."
    echo "📋 Edit config.php and update the following:"
    echo "   - \$servername (usually 'localhost')"  
    echo "   - \$username (your MySQL username)"
    echo "   - \$password (your MySQL password)"
    echo "   - \$dbname (your database name)"
else
    echo "✅ config.php already exists"
fi

echo ""
echo "🎉 Setup complete! Next steps:"
echo "1. Update config.php with your database credentials"
echo "2. Create a MySQL database"
echo "3. Import your SQL database file"
echo "4. Access the application at: http://localhost/InternetProgrammingProject/"
echo ""
echo "📊 To test the Agent API, open: http://localhost/InternetProgrammingProject/agent_api_test.html"