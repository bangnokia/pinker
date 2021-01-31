const { app, BrowserWindow, nativeImage } = require("electron");
const { exec } = require("child_process");

function createWindow() {
  const icon = nativeImage.createFromPath(__dirname + "/assets/icon.icns");
  const win = new BrowserWindow({
    width: 1200,
    height: 690,
    webPreferences: {
      nodeIntergration: true,
    },
    icon: icon,
  });

  win.loadFile("index.html");
}

app.whenReady().then(() => {
  exec(
    "cd laravel && php artisan serve --port=6969",
    (error, stdout, stderr) => {
      console.log(stdout);
      createWindow();
    }
  );
});

app.on("window-all-closed", () => {
  if (process.platform !== "darwin") {
    app.quit();
  }
});

app.on("active", () => {
  if (BrowserWindow.getAllWindows().length === 0) {
    createWindow();
  }
});

try {
  require("electron-reloader")(module);
} catch {}
