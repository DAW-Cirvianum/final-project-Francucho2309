import { Link, useNavigate } from "react-router-dom";
import { useState } from "react";
import { useAuth } from "../context/AuthContext";
import { useTranslation } from "react-i18next";
import { useCart } from "../context/CartContext";

export default function Navbar() {
  const { user, logout } = useAuth();
  const { t, i18n } = useTranslation();
  const { cart } = useCart();

  const [query, setQuery] = useState("");
  const navigate = useNavigate();

  const changeLanguage = (e) => {
    const lang = e.target.value;
    i18n.changeLanguage(lang);
    localStorage.setItem("lang", lang);
  };

  const handleSearch = (e) => {
    e.preventDefault();
    if (query.trim()) {
      navigate(`/shirt?search=${query}`);
    }
  };

  const handleLogout = async () => {
    await logout();
    navigate("/");
  };

  const cartCount = cart?.items?.length ?? 0;

  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-dark border-bottom">
      <div className="container">
        <Link className="navbar-brand text-success fw-bold fs-4" to="/">
          TopFlex
        </Link>

        <button
          className="navbar-toggler bg-success"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#mainNavbar"
        >
          <span className="navbar-toggler-icon"></span>
        </button>

        <div className="collapse navbar-collapse" id="mainNavbar">
          <form className="d-flex mx-auto my-2 my-lg-0" onSubmit={handleSearch}>
            <input
              type="search"
              className="form-control me-2"
              placeholder={t("navbar.search")}
              value={query}
              onChange={(e) => setQuery(e.target.value)}
            />
            <button type="submit" className="btn btn-success">
              {t("navbar.search_button")}
            </button>
          </form>

          <ul className="navbar-nav">
            <li className="nav-item me-3">
              <select
                className="form-select form-select-sm"
                value={i18n.language}
                onChange={changeLanguage}
              >
                <option value="es">ES</option>
                <option value="en">EN</option>
                <option value="ca">CA</option>
              </select>
            </li>
          </ul>
          <ul className="navbar-nav ms-auto">
            {!user ? (
              <>
                <li className="nav-item me-3">
                  <Link className="nav-link fw-bold text-success" to="/login">
                    {t("navbar.login")}
                  </Link>
                </li>
                <li className="nav-item me-3">
                  <Link
                    className="nav-link fw-bold text-success"
                    to="/register"
                  >
                    {t("navbar.register")}
                  </Link>
                </li>
              </>
            ) : (
              <>
                <li className="nav-item me-3">
                  <button
                    className="btn fw-bold text-success"
                    onClick={handleLogout}
                  >
                    {t("navbar.logout")}
                  </button>
                </li>
              </>
            )}
            <li className="nav-item">
              <Link className="nav-link position-relative" to="/cart">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="30"
                  height="30"
                  fill="currentColor"
                  className="bi bi-cart text-success"
                  viewBox="0 0 16 16"
                >
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                {cartCount > 0 && (
                  <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                    {cartCount}
                  </span>
                )}
              </Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
}
