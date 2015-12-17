module.exports = {
  snapshot: {
    options: {
      archive: 'build/build.zip'
    },
    files: [
      {expand: true, src: ['**', '!**/.git/**', '!node_modules/**'], dest: '', dot: true}
    ]
  },
  dist: {
    options: {
      archive: 'build/build.zip'
    },
    files: [
      {expand: true, src: ['**', '!**/.git/**', '!node_modules/**'], dest: '', dot: true}
    ]
  }

}