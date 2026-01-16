import AppRouter from "./router/AppRouter";
import { useAuth } from "./context/AuthContext";

function App() {
  const { loading } = useAuth();

  if (loading) {
    return (
      <div className="d-flex vh-100 justify-content-center align-items-center">
        <div className="spinner-border text-success" role="status" />
      </div>
    );
  }

  return <AppRouter />;
}

export default App;
