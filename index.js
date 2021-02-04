const { app, BrowserWindow, nativeImage } = require("electron");
const { fork, exec } = require("child_process");
const PHPServer = require("php-server-manager");
const path = require("path");

const server = new PHPServer({
  php: "/usr/local/bin/php",
  directory: path.resolve(__dirname) + "/laravel/public",
  port: 6969,
});

server.run();

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
  console.log("app ready");
  createWindow();
});

app.on("window-all-closed", () => {
  console.log("window all closed");
  if (process.platform !== "darwin") {
    app.quit();
  }
});

app.on("activate", () => {
  console.log("active event");
  if (BrowserWindow.getAllWindows().length === 0) {
    createWindow();
  }
});

app.on("will-quit", () => {
  server.close();
});

// try {
//   require("electron-reloader")(module);
// } catch {}
