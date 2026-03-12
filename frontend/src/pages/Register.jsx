import { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../api/axios";
import { useTranslation } from "react-i18next";

export default function Register() {
  const { t } = useTranslation();
  const navigate = useNavigate();
  const [message, setMessage] = useState([]);
  const [messageType, setMessageType] = useState(null);

  const [form, setForm] = useState({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
  });

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await api.post("/register", form);

      navigate("/login", {
        state: {
          message: response.data.message,
          type: "success",
        },
      });
    } catch (error) {
      if (error.response?.data?.errors) {
        const errors = Object.values(error.response.data.errors).flat();
        setMessage(errors);
      } else {
        setMessage([t("error.generic")]);
      }
      setMessageType("danger");
    }
  };

  return (
    <div className="container mt-5" style={{ maxWidth: 400 }}>
      <h2 className="mb-4 text-center">{t("auth.register.title")}</h2>

      {message.length > 0 &&
        message.map((text, index) => (
          <div key={index} className={`alert alert-${messageType}`}>
            {t(text)}
          </div>
        ))}

      <form onSubmit={handleSubmit}>
        <div className="mb-3">
          <label>{t("auth.name")}</label>
          <input
            className="form-control mb-2"
            value={form.name}
            onChange={(e) => {
              setForm({ ...form, name: e.target.value });
              setMessage([]);
            }}
            required
          />
        </div>

        <div className="mb-3">
          <label>{t("auth.email")}</label>
          <input
            className="form-control mb-2"
            value={form.email}
            onChange={(e) => {
              setForm({ ...form, email: e.target.value });
              setMessage([]);
            }}
            required
          />
        </div>

        <div className="mb-3">
          <label>{t("auth.password")}</label>
          <input
            type="password"
            className="form-control mb-2"
            value={form.password}
            onChange={(e) => {
              setForm({ ...form, password: e.target.value });
              setMessage([]);
            }}
            required
          />
        </div>

        <div className="mb-3">
          <label>{t("auth.confirm")}</label>
          <input
            type="password"
            className="form-control mb-3"
            value={form.password_confirmation}
            onChange={(e) => {
              setForm({ ...form, password_confirmation: e.target.value });
              setMessage([]);
            }}
            required
          />
        </div>

        <button className="btn btn-success w-100">
          {t("auth.register.button")}
        </button>
      </form>
    </div>
  );
}
