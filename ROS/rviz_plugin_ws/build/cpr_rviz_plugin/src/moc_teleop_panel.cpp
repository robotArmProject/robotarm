/****************************************************************************
** Meta object code from reading C++ file 'teleop_panel.h'
**
** Created by: The Qt Meta Object Compiler version 67 (Qt 5.5.1)
**
** WARNING! All changes made in this file will be lost!
*****************************************************************************/

#include "../../../src/cpr_rviz_plugin/src/teleop_panel.h"
#include <QtCore/qbytearray.h>
#include <QtCore/qmetatype.h>
#if !defined(Q_MOC_OUTPUT_REVISION)
#error "The header file 'teleop_panel.h' doesn't include <QObject>."
#elif Q_MOC_OUTPUT_REVISION != 67
#error "This file was generated using the moc from 5.5.1. It"
#error "cannot be used with the include files from this version of Qt."
#error "(The moc has changed too much.)"
#endif

QT_BEGIN_MOC_NAMESPACE
struct qt_meta_stringdata_cpr_rviz_plugin__TeleopPanel_t {
    QByteArrayData data[14];
    char stringdata0[212];
};
#define QT_MOC_LITERAL(idx, ofs, len) \
    Q_STATIC_BYTE_ARRAY_DATA_HEADER_INITIALIZER_WITH_OFFSET(len, \
    qptrdiff(offsetof(qt_meta_stringdata_cpr_rviz_plugin__TeleopPanel_t, stringdata0) + ofs \
        - idx * sizeof(QByteArrayData)) \
    )
static const qt_meta_stringdata_cpr_rviz_plugin__TeleopPanel_t qt_meta_stringdata_cpr_rviz_plugin__TeleopPanel = {
    {
QT_MOC_LITERAL(0, 0, 28), // "cpr_rviz_plugin::TeleopPanel"
QT_MOC_LITERAL(1, 29, 9), // "setJogVel"
QT_MOC_LITERAL(2, 39, 0), // ""
QT_MOC_LITERAL(3, 40, 7), // "initGUI"
QT_MOC_LITERAL(4, 48, 7), // "initROS"
QT_MOC_LITERAL(5, 56, 7), // "sendVel"
QT_MOC_LITERAL(6, 64, 16), // "btPressedConnect"
QT_MOC_LITERAL(7, 81, 14), // "btPressedReset"
QT_MOC_LITERAL(8, 96, 15), // "btPressedEnable"
QT_MOC_LITERAL(9, 112, 20), // "btPressedGripperOpen"
QT_MOC_LITERAL(10, 133, 21), // "btPressedGripperClose"
QT_MOC_LITERAL(11, 155, 22), // "btPressedOverrideMinus"
QT_MOC_LITERAL(12, 178, 21), // "btPressedOverridePlus"
QT_MOC_LITERAL(13, 200, 11) // "sendCommand"

    },
    "cpr_rviz_plugin::TeleopPanel\0setJogVel\0"
    "\0initGUI\0initROS\0sendVel\0btPressedConnect\0"
    "btPressedReset\0btPressedEnable\0"
    "btPressedGripperOpen\0btPressedGripperClose\0"
    "btPressedOverrideMinus\0btPressedOverridePlus\0"
    "sendCommand"
};
#undef QT_MOC_LITERAL

static const uint qt_meta_data_cpr_rviz_plugin__TeleopPanel[] = {

 // content:
       7,       // revision
       0,       // classname
       0,    0, // classinfo
      12,   14, // methods
       0,    0, // properties
       0,    0, // enums/sets
       0,    0, // constructors
       0,       // flags
       0,       // signalCount

 // slots: name, argc, parameters, tag, flags
       1,    0,   74,    2, 0x0a /* Public */,
       3,    0,   75,    2, 0x0a /* Public */,
       4,    0,   76,    2, 0x0a /* Public */,
       5,    0,   77,    2, 0x09 /* Protected */,
       6,    0,   78,    2, 0x09 /* Protected */,
       7,    0,   79,    2, 0x09 /* Protected */,
       8,    0,   80,    2, 0x09 /* Protected */,
       9,    0,   81,    2, 0x09 /* Protected */,
      10,    0,   82,    2, 0x09 /* Protected */,
      11,    0,   83,    2, 0x09 /* Protected */,
      12,    0,   84,    2, 0x09 /* Protected */,
      13,    0,   85,    2, 0x09 /* Protected */,

 // slots: parameters
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,

       0        // eod
};

void cpr_rviz_plugin::TeleopPanel::qt_static_metacall(QObject *_o, QMetaObject::Call _c, int _id, void **_a)
{
    if (_c == QMetaObject::InvokeMetaMethod) {
        TeleopPanel *_t = static_cast<TeleopPanel *>(_o);
        Q_UNUSED(_t)
        switch (_id) {
        case 0: _t->setJogVel(); break;
        case 1: _t->initGUI(); break;
        case 2: _t->initROS(); break;
        case 3: _t->sendVel(); break;
        case 4: _t->btPressedConnect(); break;
        case 5: _t->btPressedReset(); break;
        case 6: _t->btPressedEnable(); break;
        case 7: _t->btPressedGripperOpen(); break;
        case 8: _t->btPressedGripperClose(); break;
        case 9: _t->btPressedOverrideMinus(); break;
        case 10: _t->btPressedOverridePlus(); break;
        case 11: _t->sendCommand(); break;
        default: ;
        }
    }
    Q_UNUSED(_a);
}

const QMetaObject cpr_rviz_plugin::TeleopPanel::staticMetaObject = {
    { &rviz::Panel::staticMetaObject, qt_meta_stringdata_cpr_rviz_plugin__TeleopPanel.data,
      qt_meta_data_cpr_rviz_plugin__TeleopPanel,  qt_static_metacall, Q_NULLPTR, Q_NULLPTR}
};


const QMetaObject *cpr_rviz_plugin::TeleopPanel::metaObject() const
{
    return QObject::d_ptr->metaObject ? QObject::d_ptr->dynamicMetaObject() : &staticMetaObject;
}

void *cpr_rviz_plugin::TeleopPanel::qt_metacast(const char *_clname)
{
    if (!_clname) return Q_NULLPTR;
    if (!strcmp(_clname, qt_meta_stringdata_cpr_rviz_plugin__TeleopPanel.stringdata0))
        return static_cast<void*>(const_cast< TeleopPanel*>(this));
    return rviz::Panel::qt_metacast(_clname);
}

int cpr_rviz_plugin::TeleopPanel::qt_metacall(QMetaObject::Call _c, int _id, void **_a)
{
    _id = rviz::Panel::qt_metacall(_c, _id, _a);
    if (_id < 0)
        return _id;
    if (_c == QMetaObject::InvokeMetaMethod) {
        if (_id < 12)
            qt_static_metacall(this, _c, _id, _a);
        _id -= 12;
    } else if (_c == QMetaObject::RegisterMethodArgumentMetaType) {
        if (_id < 12)
            *reinterpret_cast<int*>(_a[0]) = -1;
        _id -= 12;
    }
    return _id;
}
QT_END_MOC_NAMESPACE
