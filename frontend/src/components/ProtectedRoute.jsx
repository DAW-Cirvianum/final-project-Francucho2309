import { Navigate, Outlet } from "react-router-dom";
import { useAuth } from "../context/AuthContext";
import { useTranslation } from "react-i18next";

export default function ProtectedRoute() {
  const { token, loading } = useAuth();
  const { t } = useTranslation();

  if (loading) {
    return <p className="text-center mt-5">{t("loading.shirt")}</p>;
  }

  if (!token) {
    return <Navigate to="/login" replace />;
  }

  return <Outlet />;
}
