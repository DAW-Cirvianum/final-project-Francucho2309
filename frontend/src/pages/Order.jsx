import { useEffect, useState } from "react";
import api from "../api/axios";
import { useAuth } from "../context/AuthContext";
import { Link, useLocation } from "react-router-dom";
import { useTranslation } from "react-i18next";

export default function Orders() {
  const { token } = useAuth();
  const [orders, setOrders] = useState([]);
  const { t } = useTranslation();
  const location = useLocation();

  const [message, setMessage] = useState(location.state?.message || null);

  useEffect(() => {
    if (message) {
      const timer = setTimeout(() => {
        setMessage(null);
      }, 3000);

      return () => clearTimeout(timer);
    }
  }, [message]);

  useEffect(() => {
    api
      .get("/orders", {
        headers: { Authorization: `Bearer ${token}` },
      })
      .then((res) => setOrders(res.data.data ?? res.data));
  }, [token]);

  return (
    <div className="container mt-4">
      <h2>{t("order.title")}</h2>

      {message && <div className="alert alert-success">{t(message)}</div>}

      {orders.map((order) => (
        <div key={order.id} className="border p-3 mb-3">
          <p>
            {t("order.item")} #{order.id}
          </p>
          <p>Total: {order.total_price} €</p>

          <Link to={`/orders/${order.id}`} className="btn btn-sm btn-success">
            {t("order.show")}
          </Link>
        </div>
      ))}
    </div>
  );
}
