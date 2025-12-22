const Navbar = () => {
  return (
    <nav className="navbar bg-dark">
      <div className="container-fluid">
        <a className="navbar-brand badge bg-dark text-success fs-1">TopFlex</a>
        <ul className="nav">
          <li className="nav-item">
            <a className="nav-link text-success" href="#">
              Iniciar sesión
            </a>
          </li>
          <li className="nav-item">
            <a className="nav-link text-success" href="#">
              Registrate
            </a>
          </li>
        </ul>
      </div>
    </nav>
  );
};

export default Navbar;
