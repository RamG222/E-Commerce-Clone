import { Star } from 'lucide-react';
import { Link } from 'react-router-dom';
import { Button } from '@/components/ui/button';
import { Card } from '@/components/ui/card';
import { useCart } from '@/contexts/CartContext';
import { Product } from '@/data/products';

interface ProductCardProps {
  product: Product;
}

const ProductCard = ({ product }: ProductCardProps) => {
  const { addToCart } = useCart();

  const handleAddToCart = (e: React.MouseEvent) => {
    e.preventDefault();
    addToCart({
      id: product.id,
      name: product.name,
      price: product.price,
      image: product.image,
      category: product.category,
    });
  };

  return (
    <Link to={`/product/${product.id}`}>
      <Card className="group overflow-hidden transition-shadow hover:shadow-hover cursor-pointer h-full flex flex-col">
        <div className="aspect-square overflow-hidden bg-muted">
          <img
            src={product.image}
            alt={product.name}
            className="h-full w-full object-cover transition-transform group-hover:scale-105"
          />
        </div>
        <div className="p-4 flex-1 flex flex-col">
          <h3 className="font-semibold text-sm mb-2 line-clamp-2 flex-1">
            {product.name}
          </h3>
          
          <div className="flex items-center gap-1 mb-2">
            <div className="flex">
              {Array.from({ length: 5 }).map((_, i) => (
                <Star
                  key={i}
                  className={`h-4 w-4 ${
                    i < Math.floor(product.rating)
                      ? 'fill-primary text-primary'
                      : 'text-gray-300'
                  }`}
                />
              ))}
            </div>
            <span className="text-xs text-muted-foreground">
              ({product.reviews.toLocaleString()})
            </span>
          </div>

          <div className="space-y-2">
            <p className="text-2xl font-bold text-foreground">
              ${product.price.toFixed(2)}
            </p>
            
            {product.inStock ? (
              <>
                <p className="text-xs text-green-600 font-medium">In Stock</p>
                <Button
                  onClick={handleAddToCart}
                  className="w-full bg-primary hover:bg-primary/90"
                  size="sm"
                >
                  Add to Cart
                </Button>
              </>
            ) : (
              <p className="text-xs text-destructive font-medium">Out of Stock</p>
            )}
          </div>
        </div>
      </Card>
    </Link>
  );
};

export default ProductCard;
