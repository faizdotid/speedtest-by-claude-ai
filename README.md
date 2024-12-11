# Network Speed Test

A modern, responsive web application for testing network performance metrics including download speed, upload speed, and latency. Try it live at [speedtest.xyxyweb.com](https://speedtest.xyxyweb.com/)

![Speed Test Preview](https://raw.githubusercontent.com/faizdotid/speedtest-by-claude-ai/refs/heads/main/static/image.png)

## Features

- 🚀 Real-time speed measurements
- 📊 Interactive charts and visualizations
- 🌓 Light/Dark mode support
- 📱 Fully responsive design
- 📈 Test history with local storage
- ⚡ Low-latency measurements
- 🔄 Progress indicators with smooth animations
- 💾 Local storage for settings persistence

## Technologies Used

- HTML5/CSS3
- JavaScript (ES6+)
- PHP (Backend)
- [TailwindCSS](https://tailwindcss.com/) - Styling
- [DaisyUI](https://daisyui.com/) - Component library
- [Chart.js](https://www.chartjs.org/) - Data visualization
- [SweetAlert2](https://sweetalert2.github.io/) - Beautiful alerts

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- Web server (Apache/Nginx)
- Modern web browser

### Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/speed-test.git
```

2. Move to your web server directory:
```bash
mv speed-test/src /var/www/html/
```

3. Configure your web server to point to the directory.

4. (Optional) Configure PHP settings in php.ini:
```ini
max_execution_time = 300
memory_limit = 256M
post_max_size = 8M
```

### Development

To modify the project:

1. Update CSS styles in TailwindCSS:
```bash
npx tailwindcss -i ./src/input.css -o ./dist/output.css --watch
```

2. JavaScript files are organized in the SpeedTest object for easy maintenance.

## Features in Detail

### Speed Test
- Download speed measurement
- Upload speed measurement
- Latency (ping) testing
- Jitter calculation

### Visualization
- Real-time speed graphs
- Progress indicators
- Historical data charts
- Responsive data tables

### User Interface
- Intuitive controls
- Theme switching
- Responsive design
- Touch-friendly interface

### Data Management
- Local storage for test history
- Settings persistence
- Data export capabilities
- Clear history option

## Credits

Built with ❤️ by:
- [ClaudeSonnet](https://www.anthropic.com/claude)

>> I didn't expect the result to be so good.
