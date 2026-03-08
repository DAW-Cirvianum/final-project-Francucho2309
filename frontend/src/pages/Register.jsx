import { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../api/axios";
import { useTranslation } from "react-i18next";

export default function Register() {
  const { t } = useTranslation();
  const navigate = useNavigate();

  const [form, setForm] = useState({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
  });

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      await api.post("/register", form);
      navigate("/login");
    } catch {
      alert(t("errors.generic"));
    }
  };

  return (
    <div className="container mt-5" style={{ maxWidth: 400 }}>
      <h3 className="mb-3">{t("auth.register")}</h3>

      <form onSubmit={handleSubmit}>
        <input
          className="form-control mb-2"
          placeholder={t("auth.name")}
          onChange={(e) => setForm({ ...form, name: e.target.value })}
        />

        <input
          className="form-control mb-2"
          placeholder={t("auth.email")}
          onChange={(e) => setForm({ ...form, email: e.target.value })}
        />

        <input
          type="password"
          className="form-control mb-2"
          placeholder={t("auth.password")}
          onChange={(e) => setForm({ ...form, password: e.target.value })}
        />

        <input
          type="password"
          className="form-control mb-3"
          placeholder={t("auth.confirm")}
          onChange={(e) =>
            setForm({ ...form, password_confirmation: e.target.value })
          }
        />

        <button className="btn btn-dark w-100">{t("auth.register")}</button>
      </form>
    </div>
  );
}
