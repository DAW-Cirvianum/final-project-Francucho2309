import { useCart } from "../context/CartContext";
import api from "../api/axios";
import { useAuth } from "../context/AuthContext";
import { useNavigate } from "react-router-dom";
import { useTranslation } from "react-i18next";
import { useState, useEffect } from "react";

export default function Checkout() {
  const { cart, loadCart } = useCart();
  const { token } = useAuth();
  const { t } = useTranslation();
  const navigate = useNavigate();
  const [countries, setCountries] = useState([]);
  const [message, setMessage] = useState(null);

  const [form, setForm] = useState({
    shipping_address: "",
    shipping_city: "",
    shipping_province: "",
    shipping_postal_code: "",
    shipping_country: "",
    shipping_phone: "",
  });

  const total = cart.items.reduce(
    (sum, item) => sum + item.quantity * item.shirt.price,
    0,
  );

  const confirmOrder = async () => {
    try {
      await api.post("/orders", form, {
        headers: { Authorization: `Bearer ${token}` },
      });

      navigate("/orders");
      loadCart();
    } catch {
      setMessage("error.generic");
    }
  };

  useEffect(() => {
    fetch("https://restcountries.com/v3.1/all?fields=name")
      .then((res) => res.json())
      .then((data) => {
        let countryList = data.map((c) => c.name.common);

        const extraCountries = [
          "England",
          "Scotland",
          "Wales",
          "Northern Ireland",
        ];

        countryList = [...countryList, ...extraCountries];

        countryList.sort();

        setCountries(countryList);
      });
  }, []);

  return (
    <div className="container mt-4">
      <h2 className="fw-bold mb-4">{t("shirt.checkout")}</h2>

      <div className="row">
        <div className="col-md-6">
          <div className="border p-3 rounded-3">
            <h5 className="fw-bold mb-3">{t("checkout.shipping")}</h5>

            <div className="mb-2">
              <label>{t("checkout.address")}</label>
              <input
                className="form-control"
                value={form.shipping_address}
                onChange={(e) =>
                  setForm({ ...form, shipping_address: e.target.value })
                }
                required
              />
            </div>

            <div className="mb-2">
              <label>{t("checkout.city")}</label>
              <input
                className="form-control"
                value={form.shipping_city}
                onChange={(e) =>
                  setForm({ ...form, shipping_city: e.target.value })
                }
                required
              />
            </div>

            <div className="mb-2">
              <label>{t("checkout.province")}</label>
              <input
                className="form-control"
                value={form.shipping_province}
                onChange={(e) =>
                  setForm({ ...form, shipping_province: e.target.value })
                }
                required
              />
            </div>

            <div className="mb-2">
              <label>{t("checkout.postal")}</label>
              <input
                className="form-control"
                value={form.shipping_postal_code}
                onChange={(e) =>
                  setForm({ ...form, shipping_postal_code: e.target.value })
                }
                required
              />
            </div>

            <div className="mb-2">
              <label>{t("checkout.country")}</label>

              <select
                className="form-select"
                value={form.shipping_country}
                onChange={(e) =>
                  setForm({ ...form, shipping_country: e.target.value })
                }
                required
              >
                <option value="" disabled>
                  Selecciona un país
                </option>

                {countries.map((country, index) => (
                  <option key={index} value={country}>
                    {country}
                  </option>
                ))}
              </select>
            </div>

            <div className="mb-2">
              <label>{t("checkout.phone")}</label>
              <input
                className="form-control"
                value={form.shipping_phone}
                onChange={(e) =>
                  setForm({ ...form, shipping_phone: e.target.value })
                }
              />
            </div>
          </div>
        </div>

        <div className="col-md-6">
          <div className="border p-3 rounded-3">
            <h5 className="fw-bold mb-3">{t("checkout.summary")}</h5>

            {cart.items.map((item) => (
              <div key={item.id} className="border-bottom pb-2 mb-2">
                <h6 className="fw-bold">
                  {item.shirt.name} {item.shirt.team.name}
                </h6>

                <p className="mb-1">
                  {t("shirt.size")}: {item.size}
                </p>

                <p className="mb-1">
                  {t("shirt.quantity")}: {item.quantity}
                </p>

                <p className="mb-1">{item.shirt.price} €</p>
              </div>
            ))}

            <h4 className="mt-3">Total: {total.toFixed(2)} €</h4>

            <button
              className="btn btn-success w-100 mt-3"
              onClick={confirmOrder}
            >
              {t("shirt.confirm")}
            </button>
            {message && <div className="alert alert-danger">{t(message)}</div>}
          </div>
        </div>
      </div>
    </div>
  );
}
