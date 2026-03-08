import { useEffect, useState } from "react";
import { useSearchParams, Link } from "react-router-dom";
import api from "../api/axios";
import { useTranslation } from "react-i18next";

export default function Shirts() {
  const { t } = useTranslation();
  const [shirts, setShirts] = useState([]);

  const [leagues, setLeagues] = useState([]);
  const [selectedLeague, setSelectedLeague] = useState("");

  const [teams, setTeams] = useState([]);
  const [selectedTeam, setSelectedTeam] = useState("");

  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const [searchParams] = useSearchParams();
  const search = searchParams.get("search");

  useEffect(() => {
    setLoading(true);

    api
      .get("/shirts", {
        params: {
          search: search || "",
          league_id: selectedLeague || undefined,
          team_id: selectedTeam || undefined,
        },
      })
      .then((response) => {
        setShirts(response.data.data ?? response.data);
        setError(null);
      })
      .catch(() => {
        setError(t("error.generic"));
      })
      .finally(() => {
        setLoading(false);
      });
  }, [search, selectedLeague, selectedTeam, t]);

  useEffect(() => {
    api.get("/leagues").then((response) => {
      setLeagues(response.data.data ?? response.data);
    });

    api.get("/teams").then((response) => {
      setTeams(response.data.data ?? response.data);
    });
  }, []);

  if (loading) {
    return <p className="text-center mt-5">Loading...</p>;
  }

  if (error) {
    return <p className="text-center mt-5">{error}</p>;
  }

  return (
    <div className="row">
      <aside className="col-md-3">
        <h5 className="mb-3">{t("filters.title")}</h5>

        <div className="mb-3">
          <label className="form-label">{t("filters.league")}</label>
          <select
            className="form-select mb-3"
            value={selectedLeague}
            onChange={(e) => {
              setSelectedLeague(e.target.value);
              setSelectedTeam("");
            }}
          >
            <option value="">{t("filters.all_league")}</option>
            {leagues.map((league) => (
              <option key={league.id} value={league.id}>
                {league.name}
              </option>
            ))}
          </select>
        </div>

        <div className="mb-3">
          <label className="form-label">{t("filters.team")}</label>
          <select
            className="form-select mb-3"
            value={selectedTeam}
            onChange={(e) => setSelectedTeam(e.target.value)}
            disabled={!selectedLeague}
          >
            <option value="">{t("filters.all_team")}</option>
            {teams
              .filter(
                (team) => !selectedLeague || team.league_id == selectedLeague
              )
              .map((team) => (
                <option key={team.id} value={team.id}>
                  {team.name}
                </option>
              ))}
          </select>
        </div>
      </aside>

      <section className="col-md-9">
        <h3 className="mb-4">{t("pages.shirts.title")}</h3>

        {shirts.length === 0 ? (
          <p className="text-muted text-center">{t("errors.notfound")}</p>
        ) : (
          <div className="row g-3">
            {shirts.map((shirt) => (
              <div key={shirt.id} className="col-6 col-md-4 col-lg-3">
                <div className="card h-100 shadow-sm">
                  <img
                    src={
                      shirt.images?.[0]
                        ? `http://localhost/storage/${shirt.images[0].image_path}`
                        : "https://via.placeholder.com/250x300"
                    }
                    className="card-img-top shirt-image"
                    alt={shirt.name}
                  />
                  <div className="card-body text-center">
                    <h6 className="card-title">{shirt.name}</h6>
                    <p className="text-success fw-bold">{shirt.price} €</p>
                    <Link
                      to={`/shirts/${shirt.id}`}
                      className="btn btn-success"
                    >
                      {t("card.button")}
                    </Link>
                  </div>
                </div>
              </div>
            ))}
          </div>
        )}
      </section>
    </div>
  );
}
