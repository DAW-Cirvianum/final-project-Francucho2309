import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import api from "../api/axios";
import { useAuth } from "../context/AuthContext";
import { useCart } from "../context/CartContext";
import { useTranslation } from "react-i18next";

export default function ShirtDetail() {
  const { id } = useParams();
  const { token } = useAuth();
  const { t } = useTranslation();
  const { addToCart } = useCart();

  const [shirt, setShirt] = useState(null);
  const [size, setSize] = useState("S");
  const [quantity, setQuantity] = useState(1);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    api
      .get(`/shirts/${id}`)
      .then((response) => setShirt(response.data.data ?? response.data))
      .catch(() => setError(t("errors.notfound")))
      .finally(() => setLoading(false));
  }, [id, t]);

  if (loading) {
    return <p className="text-center mt-5">Loading...</p>;
  }

  if (error) {
    return <p className="text-center mt-5">{error}</p>;
  }

  return (
    <div className="container mt-4">
      <div className="row">
        <div className="col-md-6">
          <img
            src={
              shirt.images?.[0]
                ? `http://localhost/storage/${shirt.images[0].image_path}`
                : "https://via.placeholder.com/500x600"
            }
            className="img-fluid rounded shadow shirt-detail-image"
            alt={shirt.name}
          />
        </div>

        <div className="col-md-6">
          <h2>{shirt.name}</h2>
          <p className="text-muted">
            {shirt.team?.name} . {shirt.team?.league?.name}
          </p>

          <h4 className="text-success fw-bold mb-3">{shirt.price} €</h4>

          <div className="mb-3">
            <label className="form-label">{t("shirt.size")}</label>
            <select
              className="form-select"
              value={size}
              onChange={(e) => setSize(e.target.value)}
            >
              <option value="S">S</option>
              <option value="M">M</option>
              <option value="L">L</option>
              <option value="XL">XL</option>
              <option value="XL">XXL</option>
            </select>
          </div>

          <div className="mb-3">
            <label className="form-label">{t("shirt.quantity")}</label>
            <input
              type="number"
              min="1"
              className="form-control"
              value={quantity}
              onChange={(e) => setQuantity(Number(e.target.value))}
            />
          </div>

          <button
            className="btn btn-success w-100"
            onClick={() => addToCart(shirt.id, quantity, size)}
            disabled={!token}
          >
            {token ? t("shirt.addCart") : t("shirt.loginRequired")}
          </button>
        </div>
      </div>
    </div>
  );
}
