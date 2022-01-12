const plan = require("flightplan");
const { configure } = require("@whitespace/flightplan/municipio");

let config = {
  keepReleases: 5,
  dumpFolder: "~/dumps",
  themes: [],
  shared: {
    ".env": true,
  },
  filesAndFolders: [
    // Additional files to transfer
  ],
  ignoredFilesAndFolders: [
    // Files to NOT transfer
  ],
};

plan.target(
  "jenkins",
  {
    host: process.env.FLIGHTPLAN_HOST,
    username: process.env.FLIGHTPLAN_USER,
    agent: process.env.SSH_AUTH_SOCK,
  },
  {
    dir: process.env.FLIGHTPLAN_DIR,
    user: "web",
    domain: process.env.FLIGHTPLAN_DOMAIN,
    root: "/srv/www",
    targets: [process.env.FLIGHTPLAN_TARGET_DIR],
    phpVersion: "php7.4",
  },
);

configure(plan, config);
