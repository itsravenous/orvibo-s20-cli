# Orvibo s20 cli
A clunky cli wrapper for Fernando Silva's [orvfms](https://github.com/fernadosilva/orvfms) to enable toggling your Orvibo s20 switches from the command line.

Please read the README in the orvfms repository for disclaimers and security concerns etc.

Currently only supports basic on/off functionality.

## Usage

### Get switch list (required before using switches)
`php orvibo.php list`

### Turn a switch on
`php orvibo.php on <id>`

### Turn a switch off
`php orvibo.php off <id>`

If you're just working with a single switch, you may omit the id from the off/on commands.

