import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import api from "../api/axios";
import { useAuth } from "../context/AuthContext";
import { useTranslation } from "react-i18next";

export default function OrderDetail() {
  const { id } = useParams();
  const { token } = useAuth();
  const { t } = useTranslation();

  const [order, setOrder] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api
      .get(`/orders/${id}`, {
        headers: { Authorization: `Bearer ${token}` },
      })
      .then((res) => setOrder(res.data))
      .finally(() => setLoading(false));
  }, [id, token]);

  if (loading) {
    return <p className="text-center mt-5">{t("loading.item")}</p>;
  }

  if (!order) {
    return <p className="text-center mt-5">{t("order.notfound")}</p>;
  }

  const total = order.details.reduce(
    (sum, item) => sum + item.quantity * item.price,
    0,
  );

  return (
    <div className="container mt-4">
      <h2 className="mb-4">
        {t("order.item")} #{order.id}
      </h2>

      <div className="border p-3 rounded mb-4">
        <h5>{t("checkout.shipping")}</h5>

        <p>{order.shipping_address}</p>
        <p>
          {order.shipping_city} - {order.shipping_province}
        </p>
        <p>
          {order.shipping_postal_code} {order.shipping_country}
        </p>
        <p>{order.shipping_phone}</p>
      </div>

      <h5 className="mb-3">{t("order.product")}</h5>

      {order.details.map((item) => (
        <div
          key={item.id}
          className="d-flex align-items-center border p-2 mb-2 rounded"
        >
          <img
            src={`http://localhost/storage/${item.shirt.images[0]?.image_path}`}
            width="120"
            className="rounded"
          />

          <div className="ms-3">
            <h6 className="fw-bold">
              {item.shirt.name} {item.shirt.team?.name} {item.shirt.season}
            </h6>

            <p>
              {t("shirt.size")}: {item.size}
            </p>

            <p>
              {t("shirt.quantity")}: {item.quantity}
            </p>

            <p>{item.price} €</p>
          </div>
        </div>
      ))}

      <h4 className="text-end mt-3">Total: {total.toFixed(2)} €</h4>
    </div>
  );
}
