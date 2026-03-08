import { useCart } from "../context/CartContext";
import api from "../api/axios";
import { useAuth } from "../context/AuthContext";
import { useNavigate } from "react-router-dom";

export default function Checkout() {
  const { cart, loadCart } = useCart();
  const { token } = useAuth();
  const navigate = useNavigate();

  const total = cart.items.reduce(
    (sum, item) => sum + item.quantity * item.shirt.price,
    0
  );

  const confirmOrder = async () => {
    try {
      await api.post(
        "/orders",
        {},
        {
          headers: { Authorization: `Bearer ${token}` },
        }
      );

      await loadCart();
      navigate("/orders");
    } catch {
      alert("Error al crear el pedido");
    }
  };

  return (
    <div className="container mt-4">
      <h2>Confirmar pedido</h2>

      {cart.items.map((item) => (
        <div key={item.id} className="border p-2 mb-2">
          <strong>{item.shirt.name}</strong>
          <div>Talla: {item.size}</div>
          <div>Cantidad: {item.quantity}</div>
          <div>{item.shirt.price} €</div>
        </div>
      ))}

      <h4 className="mt-3">Total: {total.toFixed(2)} €</h4>

      <button className="btn btn-success w-100 mt-3" onClick={confirmOrder}>
        Confirmar pedido
      </button>
    </div>
  );
}
