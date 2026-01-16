import { useEffect, useState } from "react";
import api from "../api/axios";
import { useAuth } from "../context/AuthContext";
import { Link } from "react-router-dom";

export default function Orders() {
  const { token } = useAuth();
  const [orders, setOrders] = useState([]);

  useEffect(() => {
    api
      .get("/orders", {
        headers: { Authorization: `Bearer ${token}` },
      })
      .then((res) => setOrders(res.data.data ?? res.data));
  }, [token]);

  return (
    <div className="container mt-4">
      <h2>Mis pedidos</h2>

      {orders.map((order) => (
        <div key={order.id} className="border p-3 mb-3">
          <p>Pedido #{order.id}</p>
          <p>Total: {order.total} €</p>

          <Link
            to={`/orders/${order.id}`}
            className="btn btn-sm btn-outline-success"
          >
            Ver detalle
          </Link>
        </div>
      ))}
    </div>
  );
}
