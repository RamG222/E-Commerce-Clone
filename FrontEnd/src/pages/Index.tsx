import { Link } from 'react-router-dom';
import { Button } from '@/components/ui/button';
import ProductCard from '@/components/ProductCard';
import { products } from '@/data/products';
import heroBanner from '@/assets/hero-banner.jpg';

const Index = () => {
  const featuredProducts = products.slice(0, 8);

  return (
    <div className="min-h-screen bg-amazon-light">
      {/* Hero Section */}
      <section className="relative h-[400px] overflow-hidden">
        <img
          src={heroBanner}
          alt="Shop the latest products"
          className="w-full h-full object-cover"
        />
        <div className="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent flex items-center">
          <div className="container mx-auto px-4">
            <div className="max-w-xl">
              <h1 className="text-4xl md:text-5xl font-bold text-white mb-4">
                Find Everything You Need
              </h1>
              <p className="text-lg text-white mb-6">
                Shop millions of products with fast, free delivery
              </p>
              <Link to="/products">
                <Button size="lg" className="bg-primary hover:bg-primary/90">
                  Shop Now
                </Button>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Featured Products */}
      <section className="container mx-auto px-4 py-12">
        <div className="flex items-center justify-between mb-8">
          <h2 className="text-3xl font-bold">Featured Products</h2>
          <Link to="/products">
            <Button variant="outline">View All</Button>
          </Link>
        </div>
        
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          {featuredProducts.map((product) => (
            <ProductCard key={product.id} product={product} />
          ))}
        </div>
      </section>

      {/* Category Cards */}
      <section className="container mx-auto px-4 py-12">
        <h2 className="text-3xl font-bold mb-8">Shop by Category</h2>
        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
          {['Electronics', 'Fashion', 'Home & Kitchen', 'Books', 'Sports', 'Toys & Games'].map(
            (category) => (
              <Link key={category} to={`/products?category=${encodeURIComponent(category)}`}>
                <div className="bg-card rounded-lg p-6 text-center hover:shadow-hover transition-shadow cursor-pointer">
                  <h3 className="font-semibold">{category}</h3>
                </div>
              </Link>
            )
          )}
        </div>
      </section>
    </div>
  );
};

export default Index;
