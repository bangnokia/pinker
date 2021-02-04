const { app, BrowserWindow, nativeImage } = require("electron");
const { fork, exec } = require("child_process");
const PHPServer = require("php-server-manager");
const path = require("path");

const server = new PHPServer({
  directory: path.resolve(__dirname) + "/laravel/public",
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
    server.close();
    app.quit();
  }
});

app.on("active", () => {
  if (BrowserWindow.getAllWindows().length === 0) {
    createWindow();
  }
});

// try {
//   require("electron-reloader")(module);
// } catch {}
