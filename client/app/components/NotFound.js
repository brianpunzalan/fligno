import React from 'react';
import CssBaseline from '@material-ui/core/CssBaseline';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';
import Container from '@material-ui/core/Container';
import Link from '@material-ui/core/Link';

function MadeWithLove() {
  return (
    <Typography variant="body2" color="textSecondary">
      {'Built with love by the '}
      <Link color="inherit" href="https://material-ui.com/">
        Material-UI
      </Link>
      {' team.'}
    </Typography>
  );
}

const useStyles = makeStyles(theme => ({
  root: {
    display: 'flex',
    flexDirection: 'column',
    minHeight: '100vh',
  },
  main: {
    marginTop: theme.spacing(8),
    marginBottom: theme.spacing(2),
  },
  footer: {
    padding: theme.spacing(2),
    marginTop: 'auto',
    backgroundColor: 'white',
  },
}));

export default function StickyFooter() {
  const classes = useStyles();

  return (
    <div className={classes.root}>
      <CssBaseline />
      <Container component="main" className={classes.main} maxWidth="sm">
        <Typography variant="h2" component="h1" gutterBottom>
          404 Page Not Found.
        </Typography>
        <Typography variant="h5" component="h2" gutterBottom>
          {'It seems you are lost my friend'}
        </Typography>
        <Typography variant="body1">Better try to go back to where you started.</Typography>
      </Container>
      <footer className={classes.footer}>
        <Container maxWidth="sm">
          <Typography variant="body1">Brought to you by Fligno</Typography>
          <MadeWithLove />
        </Container>
      </footer>
    </div>
  );
}
