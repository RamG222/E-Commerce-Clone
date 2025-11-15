import { Search, ShoppingCart, Menu, MapPin } from 'lucide-react';
import { Link, useNavigate } from 'react-router-dom';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { useCart } from '@/contexts/CartContext';
import { useState } from 'react';
import { categories } from '@/data/products';

const Header = () => {
  const { itemCount } = useCart();
  const navigate = useNavigate();
  const [searchQuery, setSearchQuery] = useState('');

  const handleSearch = (e: React.FormEvent) => {
    e.preventDefault();
    if (searchQuery.trim()) {
      navigate(`/products?search=${encodeURIComponent(searchQuery)}`);
    }
  };

  return (
    <header className="sticky top-0 z-50">
      {/* Top Navigation Bar */}
      <div className="bg-amazon-nav text-white">
        <div className="container mx-auto px-4">
          <div className="flex items-center justify-between h-16">
            {/* Logo */}
            <Link to="/" className="flex items-center space-x-2">
              <ShoppingCart className="h-8 w-8 text-primary" />
              <span className="text-2xl font-bold">Amazon</span>
            </Link>

            {/* Delivery Location */}
            <button className="hidden md:flex items-center gap-2 hover:ring-1 hover:ring-white px-2 py-1 rounded">
              <MapPin className="h-5 w-5" />
              <div className="text-left">
                <p className="text-xs text-gray-300">Deliver to</p>
                <p className="text-sm font-bold">United States</p>
              </div>
            </button>

            {/* Search Bar */}
            <form onSubmit={handleSearch} className="flex-1 max-w-2xl mx-4">
              <div className="flex">
                <Input
                  type="search"
                  placeholder="Search products..."
                  value={searchQuery}
                  onChange={(e) => setSearchQuery(e.target.value)}
                  className="rounded-r-none border-primary focus-visible:ring-primary"
                />
                <Button
                  type="submit"
                  className="rounded-l-none bg-primary hover:bg-primary/90"
                >
                  <Search className="h-5 w-5" />
                </Button>
              </div>
            </form>

            {/* Cart */}
            <Link to="/cart">
              <Button variant="ghost" className="relative text-white hover:ring-1 hover:ring-white">
                <ShoppingCart className="h-6 w-6" />
                {itemCount > 0 && (
                  <span className="absolute -top-1 -right-1 bg-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                    {itemCount}
                  </span>
                )}
                <span className="ml-2 hidden sm:inline">Cart</span>
              </Button>
            </Link>
          </div>
        </div>
      </div>

      {/* Category Navigation */}
      <div className="bg-amazon-dark text-white">
        <div className="container mx-auto px-4">
          <div className="flex items-center gap-4 h-10 overflow-x-auto">
            <Button variant="ghost" size="sm" className="text-white hover:bg-white/10 whitespace-nowrap">
              <Menu className="h-4 w-4 mr-2" />
              All
            </Button>
            {categories.map((category) => (
              <Link key={category} to={`/products?category=${encodeURIComponent(category)}`}>
                <Button variant="ghost" size="sm" className="text-white hover:bg-white/10 whitespace-nowrap">
                  {category}
                </Button>
              </Link>
            ))}
          </div>
        </div>
      </div>
    </header>
  );
};

export default Header;
