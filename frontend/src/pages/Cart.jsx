import { useCart } from "../context/CartContext";
import { useNavigate } from "react-router-dom";
import { useTranslation } from "react-i18next";

export default function Cart() {
  const { cart, loading, updateItem, removeItem } = useCart();
  const { t } = useTranslation();
  const navigate = useNavigate();

  const handleCheckout = async () => {
    navigate("/checkout");
  };

  if (loading) {
    return <p className="text-center mt-5">{t("loading.item")}</p>;
  }

  if (!cart) {
    return null;
  }

  if (!cart.items || cart.items.length === 0) {
    return <p className="text-center mt-5">{t("cart.empty")}</p>;
  }

  const total = cart.items.reduce(
    (sum, item) => sum + item.quantity * item.shirt.price,
    0,
  );

  return (
    <div className="container mt-4">
      <h2>{t("cart.title")}</h2>

      {cart.items.map((item) => (
        <div
          key={item.id}
          className="d-flex align-items-center mb-3 border p-2 rounded-3"
        >
          <img
            src={`http://localhost/storage/${item.shirt.images[0]?.image_path}`}
            width="200"
            className="rounded-3"
          />

          <div className="ms-3 flex-grow-1">
            <h6 className="fw-bold fs-4">
              {item.shirt.name} {item.shirt.team.name} {item.shirt.season}
            </h6>
            <p>
              <span className="fw-bold">{t("shirt.size")}:</span> {item.size}
            </p>
            <p>
              <span className="fw-bold">{t("shirt.price")}:</span>{" "}
              {item.shirt?.price} €
            </p>

            <input
              type="number"
              min="1"
              value={item.quantity}
              onChange={(e) => updateItem(item.id, e.target.value)}
              className="form-control w-25"
            />
          </div>

          <button
            className="btn btn-danger"
            onClick={() => removeItem(item.id)}
          >
            X
          </button>
        </div>
      ))}

      <h4 className="text-end">Total: {total.toFixed(2)} €</h4>

      <button className="btn btn-success w-100 mt-3" onClick={handleCheckout}>
        {t("cart.finish")}
      </button>
    </div>
  );
}
