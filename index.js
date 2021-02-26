const { app, BrowserWindow, nativeImage } = require("electron");
const { fork, exec } = require("child_process");
const PHPServer = require("php-server-manager");
const path = require("path");
const fixPath = require("fix-path");
const fse = require("fs-extra");
const homeDir = require("os").homedir();

const basePath = path.resolve(__dirname);
const laravelPath = basePath + "/laravel";
const pinkerUserPath = homeDir + "/.pinker";

function ensureStoragePathExists() {
  if (!fse.pathExistsSync(homeDir + "/.pinker/database.sqlite")) {
    fse.copySync(
      basePath + "/database.sqlite.example",
      homeDir + "/.pinker/database.sqlite"
    );
  }
}

function ensureDatabaseFileExists() {
  fse.ensureDirSync(pinkerUserPath + "/storage/app");
  fse.ensureDirSync(pinkerUserPath + "/storage/cache");
  fse.ensureDirSync(pinkerUserPath + "/storage/framework/cache");
  fse.ensureDirSync(pinkerUserPath + "/storage/framework/sessions");
  fse.ensureDirSync(pinkerUserPath + "/storage/framework/views");
  fse.ensureDirSync(pinkerUserPath + "/storage/framework/testing");
  fse.ensureDirSync(pinkerUserPath + "/storage/logs");
}

fixPath();
ensureDatabaseFileExists();
ensureStoragePathExists();

// start php server
const server = new PHPServer({
  directory: laravelPath + "/public",
  port: 6969,
});

function createWindow() {
  const icon = nativeImage.createFromPath(__dirname + "/assets/icon.icns");
  const win = new BrowserWindow({
    width: 1200,
    height: 690,
    webPreferences: {
      contextIsolation: true,
    },
    backgroundColor: "#24262f",
    icon: icon,
  });

  win.loadURL("http://127.0.0.1:6969");
  win.focus();
}

app.whenReady().then(() => {
  server.run();
  createWindow();
});

app.on("window-all-closed", () => {
  if (process.platform !== "darwin") {
    app.quit();
  }
});

app.on("activate", () => {
  if (BrowserWindow.getAllWindows().length === 0) {
    createWindow();
  }
});

app.on("will-quit", () => {
  server.close();
});
