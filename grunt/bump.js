module.exports = {
    options: {
        files: [
          "package.json",
          "config/laravel-rest-cms.php"
        ],
        commit: true,
        commitMessage: 'Version: %VERSION%',
        commitFiles: [
          "package.json",
          "config/laravel-rest-cms.php"
        ],
        createTag: true,
        tagName: 'v%VERSION%',
        tagMessage: 'Version %VERSION%',
        push: true,
        pushTo: 'origin HEAD:develop'      
      }
};

