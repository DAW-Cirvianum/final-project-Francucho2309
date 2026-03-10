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
  const [error, setError] = useState(null);

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      await api.post("/register", form);
      navigate("/login");
    } catch (error) {
      // alert(t("errors.generic"));
      console.log(error.response.data);
    }
  };

  return (
    <div className="container mt-5" style={{ maxWidth: 400 }}>
      <h2 className="mb-4 text-center">{t("auth.register.title")}</h2>

      <form onSubmit={handleSubmit}>
        <div className="mb-3">
          <label>{t("auth.register.name")}</label>
          <input
            className="form-control mb-2"
            value={form.name}
            onChange={(e) => setForm({ ...form, name: e.target.value })}
          />
        </div>

        <div className="mb-3">
          <label>{t("auth.register.email")}</label>
          <input
            className="form-control mb-2"
            value={form.email}
            onChange={(e) => setForm({ ...form, email: e.target.value })}
          />
        </div>

        <div className="mb-3">
          <label>{t("auth.register.password")}</label>
          <input
            type="password"
            className="form-control mb-2"
            value={form.password}
            onChange={(e) => setForm({ ...form, password: e.target.value })}
          />
        </div>

        <div className="mb-3">
          <label>{t("auth.register.confirm")}</label>
          <input
            type="password"
            className="form-control mb-3"
            value={form.password_confirmation}
            onChange={(e) =>
              setForm({ ...form, password_confirmation: e.target.value })
            }
          />
        </div>

        <button className="btn btn-success w-100">
          {t("auth.register.button")}
        </button>
      </form>
    </div>
  );
}
