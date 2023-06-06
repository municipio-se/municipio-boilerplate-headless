const plan = require("flightplan");
const { configure } = require("@whitespace/flightplan/municipio2");

const phpVersion = "php8.1";

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
  composerInstallArgs: "--ignore-platform-reqs --no-dev --no-interaction",
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
  },
);

configure(plan, config);

plan.remote(`deploy`, (remote) => {
  remote.exec(`sudo service ${phpVersion}-fpm reload`);
});
