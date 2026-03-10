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
        setError([t("error.verify_email")]);
      } else if (error.response?.data?.errors) {
        const errors = Object.values(error.response.data.errors).flat();
        setError(errors);
      } else {
        setError([t("error.generic")]);
      }
    }
  };

  return (
    <div className="container mt-5" style={{ maxWidth: "400px" }}>
      <h2 className="mb-4 text-center">{t("auth.login.title")}</h2>

      {error.length > 0 &&
        error.map((err, index) => (
          <div key={index} className="alert alert-danger">
            {t(err)}
          </div>
        ))}

      <form onSubmit={handleSubmit}>
        <div className="mb-3">
          <label>{t("auth.email")}</label>
          <input
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
          <label>{t("auth.password")}</label>
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
