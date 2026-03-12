import { useCart } from "../context/CartContext";
import api from "../api/axios";
import { useAuth } from "../context/AuthContext";
import { useNavigate } from "react-router-dom";
import { useTranslation } from "react-i18next";

export default function Checkout() {
  const { cart, loadCart } = useCart();
  const { token } = useAuth();
  const { t } = useTranslation();
  const navigate = useNavigate();

  const total = cart.items.reduce(
    (sum, item) => sum + item.quantity * item.shirt.price,
    0,
  );

  const confirmOrder = async () => {
    try {
      await api.post(
        "/orders",
        {},
        {
          headers: { Authorization: `Bearer ${token}` },
        },
      );

      await loadCart();
      navigate("/orders");
    } catch {
      alert("Error al crear el pedido");
    }
  };

  return (
    <div className="container mt-4">
      <h2 className="fw-bold">{t("shirt.checkout")}</h2>

      {cart.items.map((item) => (
        <div key={item.id} className="border p-2 mb-2 rounded-3">
          <h6 className="fw-bold fs-4">
            {item.shirt.name} {item.shirt.team.name} {item.shirt.season}
          </h6>
          <p>
            <span className="fw-bold">{t("shirt.size")}</span>: {item.size}
          </p>
          <p>
            <span className="fw-bold">{t("shirt.quantity")}</span>:
            {item.quantity}
          </p>
          <p>
            <span className="fw-bold">{t("shirt.price")}</span>:{" "}
            {item.shirt.price} €
          </p>
        </div>
      ))}

      <h4 className="mt-3">Total: {total.toFixed(2)} €</h4>

      <button className="btn btn-success w-100 mt-3" onClick={confirmOrder}>
        {t("shirt.confirm")}
      </button>
    </div>
  );
}
