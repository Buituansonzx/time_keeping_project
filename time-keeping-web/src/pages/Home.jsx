import React from 'react';
import Sidebar from '../components/Sidebar/Sidebar';
import '../styles/Home.css';
import "bootstrap/dist/css/bootstrap.min.css";
import Button from '../components/Button';

function Home() {
    const now = new Date();
    return (
      <div className="app-layout">
        <Sidebar />
        <main className="main-content p-4 min-vh-100">
          <div className="d-flex flex-column gap-1 mb-4">
            <h1 className="fw-semibold mb-0 text-light fs-2 fs-md-1">
              Dashboard Overview
            </h1>
            <span className="text-secondary h4 fs-md-5">
              {now.toLocaleDateString("en-US", {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
              })}
            </span>
          </div>
          <div className="container-checkin p-4 bg-dark rounded-3 d-flex flex-column flex-md-row gap-4 gap-md-0 justify-content-between align-items-start align-items-md-center">
            <div>
              <div className="d-flex align-items-center gap-2 mb-2">
                <span
                  className="rounded-circle bg-secondary"
                  style={{ width: 10, height: 10 }}
                ></span>
                <small className="h4 text-secondary m-0">Not Clocked In</small>
              </div>

              <h3 className="text-white fw-semibold mb-1 ">Ready to start</h3>

              <p className="text-secondary mb-0 ">
                Click the button to start your work session
              </p>
            </div>

            <Button
              className="btn-checkin btn btn-primary px-4 py-2 d-flex align-items-center gap-2"
              //   onClick={handleClockIn}
            >
              <span className="checkin-icon">
                <span className="checkin-play"></span>
              </span>
              Check In            
            </Button>
          </div>
        </main>
      </div>
    );
}

export default Home;