#!/bin/bash

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${GREEN}Setting up local development environment...${NC}"

# Create necessary directories
mkdir -p letsencrypt

# Set default environment variables if not exist
if [ ! -f .env ]; then
    echo -e "${YELLOW}Creating .env file...${NC}"
    cp .env.example .env
    echo "WWWGROUP=$(id -g)" >> .env
    echo "WWWUSER=$(id -u)" >> .env
fi

# Detect OS and setup DNS
OS="$(uname -s)"
case "${OS}" in
    Linux*)
        echo -e "${YELLOW}Setting up DNS for Linux...${NC}"
        if ! command -v dnsmasq &> /dev/null; then
            sudo apt-get update
            sudo apt-get install -y dnsmasq
        fi
        echo 'address=/.sitebuilder.test/127.0.0.1' | sudo tee -a /etc/dnsmasq.conf
        sudo systemctl restart dnsmasq
        ;;
    Darwin*)
        echo -e "${YELLOW}Setting up DNS for macOS...${NC}"
        if ! command -v brew &> /dev/null; then
            echo "Please install Homebrew first: https://brew.sh"
            exit 1
        fi
        brew install dnsmasq
        mkdir -p $(brew --prefix)/etc/dnsmasq.d
        echo 'address=/.sitebuilder.test/127.0.0.1' >> $(brew --prefix)/etc/dnsmasq.d/sitebuilder.conf
        sudo brew services restart dnsmasq
        sudo mkdir -p /etc/resolver
        echo 'nameserver 127.0.0.1' | sudo tee /etc/resolver/test
        ;;
    MINGW*|CYGWIN*|MSYS*)
        echo -e "${YELLOW}For Windows, please install Acrylic DNS Proxy manually and add:${NC}"
        echo "127.0.0.1 *.sitebuilder.test"
        echo "to your Acrylic hosts file."
        ;;
esac

# Start Docker services
echo -e "${GREEN}Starting Docker services...${NC}"
./vendor/bin/sail down
./vendor/bin/sail up -d

echo -e "${GREEN}Setup complete!${NC}"
echo -e "You can now access:"
echo -e "- https://app.sitebuilder.test"
echo -e "- https://admin.sitebuilder.test"
echo -e "- https://[any-subdomain].sitebuilder.test"
