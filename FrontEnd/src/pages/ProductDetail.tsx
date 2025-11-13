import { useParams, Link } from 'react-router-dom';
import { Star, Truck, ShieldCheck, RotateCcw } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { useCart } from '@/contexts/CartContext';
import { products } from '@/data/products';
import { Card } from '@/components/ui/card';

const ProductDetail = () => {
  const { id } = useParams();
  const { addToCart } = useCart();
  const product = products.find((p) => p.id === id);

  if (!product) {
    return (
      <div className="min-h-screen bg-amazon-light flex items-center justify-center">
        <div className="text-center">
          <h1 className="text-3xl font-bold mb-4">Product not found</h1>
          <Link to="/products">
            <Button>Browse Products</Button>
          </Link>
        </div>
      </div>
    );
  }

  const handleAddToCart = () => {
    addToCart({
      id: product.id,
      name: product.name,
      price: product.price,
      image: product.image,
      category: product.category,
    });
  };

  return (
    <div className="min-h-screen bg-amazon-light">
      <div className="container mx-auto px-4 py-8">
        {/* Breadcrumb */}
        <div className="text-sm text-muted-foreground mb-6">
          <Link to="/" className="hover:text-primary">
            Home
          </Link>
          {' > '}
          <Link to="/products" className="hover:text-primary">
            Products
          </Link>
          {' > '}
          <Link to={`/products?category=${product.category}`} className="hover:text-primary">
            {product.category}
          </Link>
          {' > '}
          <span className="text-foreground">{product.name}</span>
        </div>

        <div className="grid md:grid-cols-2 gap-8 mb-12">
          {/* Product Image */}
          <div className="bg-card rounded-lg overflow-hidden">
            <img
              src={product.image}
              alt={product.name}
              className="w-full h-full object-cover"
            />
          </div>

          {/* Product Info */}
          <div>
            <h1 className="text-3xl font-bold mb-4">{product.name}</h1>

            {/* Rating */}
            <div className="flex items-center gap-2 mb-4">
              <div className="flex">
                {Array.from({ length: 5 }).map((_, i) => (
                  <Star
                    key={i}
                    className={`h-5 w-5 ${
                      i < Math.floor(product.rating)
                        ? 'fill-primary text-primary'
                        : 'text-gray-300'
                    }`}
                  />
                ))}
              </div>
              <span className="text-primary font-medium">{product.rating}</span>
              <span className="text-muted-foreground">
                ({product.reviews.toLocaleString()} reviews)
              </span>
            </div>

            {/* Price */}
            <div className="border-t border-b py-4 mb-6">
              <p className="text-4xl font-bold text-foreground mb-2">
                ${product.price.toFixed(2)}
              </p>
              {product.inStock ? (
                <p className="text-green-600 font-medium">In Stock</p>
              ) : (
                <p className="text-destructive font-medium">Currently Unavailable</p>
              )}
            </div>

            {/* Description */}
            <div className="mb-6">
              <h2 className="text-xl font-semibold mb-2">About this item</h2>
              <p className="text-muted-foreground mb-4">{product.description}</p>
              <ul className="space-y-2">
                {product.features.map((feature, index) => (
                  <li key={index} className="flex items-start gap-2">
                    <span className="text-primary mt-1">•</span>
                    <span>{feature}</span>
                  </li>
                ))}
              </ul>
            </div>

            {/* Add to Cart */}
            {product.inStock && (
              <Button
                onClick={handleAddToCart}
                size="lg"
                className="w-full md:w-auto bg-primary hover:bg-primary/90 mb-4"
              >
                Add to Cart
              </Button>
            )}

            {/* Delivery Info */}
            <div className="grid grid-cols-1 gap-3 mt-6">
              <div className="flex items-center gap-3 text-sm">
                <Truck className="h-5 w-5 text-primary" />
                <span>Free delivery on orders over $25</span>
              </div>
              <div className="flex items-center gap-3 text-sm">
                <ShieldCheck className="h-5 w-5 text-primary" />
                <span>1-year warranty included</span>
              </div>
              <div className="flex items-center gap-3 text-sm">
                <RotateCcw className="h-5 w-5 text-primary" />
                <span>30-day return policy</span>
              </div>
            </div>
          </div>
        </div>

        {/* Customer Reviews Section */}
        <Card className="p-6">
          <h2 className="text-2xl font-bold mb-6">Customer Reviews</h2>
          <div className="space-y-6">
            {[
              {
                name: 'John D.',
                rating: 5,
                date: '2 weeks ago',
                comment: 'Excellent product! Exceeded my expectations.',
              },
              {
                name: 'Sarah M.',
                rating: 4,
                date: '1 month ago',
                comment: 'Great quality, fast shipping. Would recommend!',
              },
              {
                name: 'Mike R.',
                rating: 5,
                date: '2 months ago',
                comment: 'Perfect for what I needed. Very satisfied with the purchase.',
              },
            ].map((review, index) => (
              <div key={index} className="border-b last:border-b-0 pb-4 last:pb-0">
                <div className="flex items-center gap-2 mb-2">
                  <p className="font-semibold">{review.name}</p>
                  <div className="flex">
                    {Array.from({ length: 5 }).map((_, i) => (
                      <Star
                        key={i}
                        className={`h-4 w-4 ${
                          i < review.rating
                            ? 'fill-primary text-primary'
                            : 'text-gray-300'
                        }`}
                      />
                    ))}
                  </div>
                </div>
                <p className="text-sm text-muted-foreground mb-2">{review.date}</p>
                <p className="text-foreground">{review.comment}</p>
              </div>
            ))}
          </div>
        </Card>
      </div>
    </div>
  );
};

export default ProductDetail;
