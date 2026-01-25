import { useState } from "react";
import "./Sidebar.css";
import {
  FiHome,
  FiClock,
  FiCalendar,
  FiFileText,
  FiLogOut,
  FiChevronLeft,
  FiChevronRight,
  FiUser,
} from "react-icons/fi";
import { useAuthContext } from "../../context/AuthContext";

export default function Sidebar() {
  const [collapsed, setCollapsed] = useState(false);
  const user = localStorage.getItem("user");
  const name = user ? JSON.parse(user).name : "Guest";
  const { logout } = useAuthContext();
  const handleLogout = () => {
     logout();
  }
  return (
    <aside className={`sidebar ${collapsed ? "collapsed" : ""}`}>
      {/* Header - User info */}
      <div className="sidebar-header user-header">
        <div className="user-info">
          <div className="avatar-icon">
            <FiUser />
          </div>

          {!collapsed && (
            <div className="user-text">
              <span className="user-name">{name}</span>
            </div>
          )}
        </div>

        <button
          className="collapse-btn"
          onClick={() => setCollapsed(!collapsed)}
        >
          {collapsed ? <FiChevronRight /> : <FiChevronLeft />}
        </button>
      </div>

      {/* Menu */}
      <ul className="menu">
        <li className="menu-item active">
          <FiHome className="icon" />
          {!collapsed && <span>Home</span>}
        </li>

        <li className="menu-item">
          <FiClock className="icon" />
          {!collapsed && <span>Chấm công</span>}
        </li>

        <li className="menu-item">
          <FiCalendar className="icon" />
          {!collapsed && <span>Lịch sử</span>}
        </li>

        <li className="menu-item">
          <FiFileText className="icon" />
          {!collapsed && <span>Đơn từ</span>}
        </li>
      </ul>

      {/* Footer - Logout */}
      <div
        className="sidebar-footer logout"
        onClick={handleLogout}
        role="button"
        tabIndex={0}
      >
        <FiLogOut className="icon" />
        {!collapsed && <span>Đăng xuất</span>}
      </div>
    </aside>
  );
}
