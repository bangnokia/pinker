const { app, BrowserWindow, nativeImage } = require("electron");
const { fork, exec } = require("child_process");
const PHPServer = require("php-server-manager");
const path = require("path");
const fixPath = require("fix-path");
const { existsSync, realpath } = require("fs");
const fse = require("fs-extra");
const homeDir = require("os").homedir();

fixPath();

let laravelPath = path.resolve(__dirname) + "/laravel";

if (app.isPackaged) {
  laravelPath = homeDir + "/.pinker/laravel";

  if (!existsSync(laravelPath)) {
    fse.ensureDirSync(laravelPath);
    fse.copySync(
      path.resolve(__dirname) + "/laravel",
      homeDir + "/.pinker/laravel"
    );
  }
}

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
