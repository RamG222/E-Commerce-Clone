# E-Commerce Clone

A full-stack e-commerce application with a modern React frontend and PHP backend.

## Project Structure

```
E-Commerce-Clone/
├── FrontEnd/           # React + TypeScript + Vite frontend
└── BackEnd/            # PHP backend with MySQL
```

## Frontend

Modern e-commerce UI built with React, TypeScript, and Vite.

### Screenshots

![Home Page](./FrontEnd/public/screenshots/home.png)
*Amazon-style homepage with hero banner and navigation*

![Product Detail](./FrontEnd/public/screenshots/product.png)
*Product page with ratings, pricing, and cart functionality*

![Shopping Cart](./FrontEnd/public/screenshots/cart.png)
*Shopping cart with order summary and checkout*

### Features
- 🛒 Shopping cart with local state management
- 📱 Fully responsive design
- 🎨 Modern UI with Tailwind CSS and shadcn/ui
- ⚡ Fast development with Vite + SWC
- 🔍 Product search and filtering
- 📦 Multiple product categories

### Tech Stack
- React 18
- TypeScript
- Vite
- Tailwind CSS
- shadcn/ui components
- React Router
- React Context API

### Getting Started

```bash
cd FrontEnd
npm install
npm run dev
# App runs at http://localhost:8080
```

See [FrontEnd/README.md](./FrontEnd/README.md) for detailed documentation.

## Backend

PHP-based backend with MySQL database.

### Features
- Product management
- Category management
- Brand management
- Database operations

### Files
- `connection.php` - Database connection
- `add_product.php` - Product management
- `add_category.php` - Category management
- `add_brand.php` - Brand management
- `dashboard.php` - Admin dashboard

## Development

### Prerequisites
- Node.js 18+ (for frontend)
- PHP 7.4+ (for backend)
- MySQL 5.7+

### Running the Application

**Frontend:**
```bash
cd FrontEnd
npm install
npm run dev
```

**Backend:**
Set up a local PHP server and MySQL database, then configure `BackEnd/connection.php` with your credentials.

## License

MIT