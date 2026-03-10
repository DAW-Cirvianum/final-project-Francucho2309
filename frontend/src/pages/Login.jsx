import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";
import { useTranslation } from "react-i18next";

export default function Login() {
  const { login } = useAuth();
  const navigate = useNavigate();

  const { t } = useTranslation();

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState([]);

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      await login(email, password);
      navigate("/shirts");
    } catch (error) {
      if (error.response?.status === 403) {
        setError([t("error.login.verify_email")]);
      } else {
        setError([t("error.login.invalid_credential")]);
      }
    }
  };

  return (
    <div className="container mt-5" style={{ maxWidth: "400px" }}>
      <h2 className="mb-4 text-center">{t("auth.login.title")}</h2>

      {error.length > 0 &&
        error.map((err, index) => (
          <div key={index} className="alert alert-danger">
            {err}
          </div>
        ))}

      <form onSubmit={handleSubmit}>
        <div className="mb-3">
          <label>{t("auth.login.email")}</label>
          <input
            type="email"
            className="form-control"
            value={email}
            onChange={(e) => {
              setEmail(e.target.value);
              setError([]);
            }}
            required
          />
        </div>

        <div className="mb-3">
          <label>{t("auth.login.password")}</label>
          <input
            type="password"
            className="form-control"
            value={password}
            onChange={(e) => {
              setPassword(e.target.value);
              setError([]);
            }}
            required
          />
        </div>

        <button className="btn btn-success w-100">
          {t("auth.login.button")}
        </button>
      </form>
    </div>
  );
}
