/**
 * 
 */
const vscode = require('vscode');

/**
 * @param {vscode.ExtensionContext} context
 */
function activate(context) {
  let disposable = vscode.commands.registerCommand('extension.xunyuCommandRecorderStart', function () {
    let recorder = require('./commands/CommandRecorder');
    recorder.start();
  });
  context.subscriptions.push(disposable);
}
exports.activate = activate;

/**
 * this method is called when your extension is deactivated
 **/ 
function deactivate() {}

module.exports = {
  activate,
  deactivate
}