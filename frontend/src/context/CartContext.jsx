import { createContext, useContext, useEffect, useState } from "react";
import api from "../api/axios";
import { useAuth } from "./AuthContext";

const CartContext = createContext();

export function CartProvider({ children }) {
  const { token } = useAuth();
  const [cart, setCart] = useState(null);
  const [loading, setLoading] = useState(false);

  const loadCart = async () => {
    if (!token) {
      setCart(null);
      return;
    }

    setLoading(true);
    try {
      const response = await api.get("/cart", {
        headers: { Authorization: `Bearer ${token}` },
      });
      setCart(response.data.data);
    } catch (e) {
      console.error("Error loading cart");
    } finally {
      setLoading(false);
    }
  };

  const addToCart = async (shirt_id, quantity, size) => {
    await api.post(
      "/cart/items",
      { shirt_id, quantity, size },
      { headers: { Authorization: `Bearer ${token}` } }
    );
    loadCart();
  };

  const updateItem = async (itemId, quantity) => {
    await api.put(
      `/cart/items/${itemId}`,
      { quantity },
      { headers: { Authorization: `Bearer ${token}` } }
    );
    loadCart();
  };

  const removeItem = async (itemId) => {
    await api.delete(`/cart/items/${itemId}`, {
      headers: { Authorization: `Bearer ${token}` },
    });
    loadCart();
  };

  useEffect(() => {
    loadCart();
  }, [token]);

  return (
    <CartContext.Provider
      value={{ cart, loading, addToCart, updateItem, removeItem }}
    >
      {children}
    </CartContext.Provider>
  );
}

export const useCart = () => useContext(CartContext);
