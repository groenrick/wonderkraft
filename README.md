# Local Development Setup Guide

## Prerequisites
- Docker Desktop
- Git
- Composer

## Quick Setup

1. Clone the repository and install dependencies:
```bash
git clone [your-repo]
cd [your-repo]
composer install
```

2. Copy the environment files:
```bash
cp .env.example .env
cp docker-compose.example.yml docker-compose.yml
```

3. Run the setup script:
```bash
./setup-local-dev.sh
```

## Manual DNS Setup (if automatic setup fails)

### macOS
```bash
brew install dnsmasq
echo 'address=/.wonderkraft.test/127.0.0.1' >> $(brew --prefix)/etc/dnsmasq.d/sitebuilder.conf
echo 'address=/wonderkraft.test/127.0.0.1' >> $(brew --prefix)/etc/dnsmasq.d/sitebuilder.conf
sudo brew services restart dnsmasq
sudo mkdir -p /etc/resolver
echo 'nameserver 127.0.0.1' | sudo tee /etc/resolver/test
```

### Linux
```bash
sudo apt-get install dnsmasq
echo 'address=/.wonderkraft.test/127.0.0.1' | sudo tee -a /etc/dnsmasq.conf
echo 'address=/wonderkraft.test/127.0.0.1' | sudo tee -a /etc/dnsmasq.conf
sudo systemctl restart dnsmasq
```

### Windows
1. Install Acrylic DNS Proxy from https://mayakron.altervista.org/support/acrylic/Home.htm
2. Add this line to Acrylic's host file:
   ```
   127.0.0.1 *.wonderkraft.test
   127.0.0.1 wonderkraft.test
   ```
3. Set your network adapter's DNS to 127.0.0.1

## Usage

After setup, you can access:
- https://app.sitebuilder.test
- https://admin.sitebuilder.test
- https://[any-subdomain].sitebuilder.test

## Troubleshooting

### Certificate Warnings
The SSL certificate is self-signed for local development. You can safely proceed through browser warnings.

### Port Conflicts
If you see port conflicts, check if you have other services running on ports 80 or 443.

### DNS Issues
If domains aren't resolving:
1. Check if dnsmasq/Acrylic is running
2. Try flushing your DNS cache:
    - macOS: `sudo killall -HUP mDNSResponder`
    - Linux: `sudo systemctl restart systemd-resolved`
    - Windows: `ipconfig /flushdns`
