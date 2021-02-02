const { app, BrowserWindow, nativeImage } = require("electron");
const { fork } = require("child_process");

function createWindow() {
  const icon = nativeImage.createFromPath(__dirname + "/assets/icon.icns");
  const win = new BrowserWindow({
    width: 1200,
    height: 690,
    webPreferences: {
      contextIsolation: true
    },
    icon: icon,
  });

  win.loadFile("index.html");
}

app.whenReady().then(() => {
  const forked = fork('serve.js');
  createWindow();
});

app.on("window-all-closed", () => {
  if (process.platform !== "darwin") {
    app.quit();
    forked.kill();
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
